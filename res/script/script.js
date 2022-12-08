
//Carregamento dos produtos
$('#select_tipo_produto_comanda').change(function (e) {
    e.preventDefault();

    id_tipo = $('#select_tipo_produto_comanda').val()

    $.ajax({
        type: "get",
        url: "/cardapio/ajax/tipo",
        data: { idtipo: id_tipo },
        dataType: "json",
        success: function (response) {

            $('#select_produto_comanda').empty()

            if (response.length == 0) {
                $('#select_produto_comanda').prepend('<option selected disabled value="invalido">Não há produtos desse tipo </option>')
            }


            //Carrega os produtos de acordo com o tipo selecionado
            for (let index = 0; index < response.length; index++) {
                $('#select_produto_comanda').prepend('<option value=' + response[index].idproduto + '>' + response[index].nomeproduto + '</option>')
            }
            $('#select_produto_comanda').prepend('<option selected disabled>Selecione o produto</option>')
        }
    });

});


//Carregamento dos ingredientes do produto na comanda
$('#select_produto_comanda').change(function (e) {
    e.preventDefault()

    id_produto = $('#select_produto_comanda').val()

    $.ajax({
        type: "get",
        url: "/comanda/ajax",
        data: { idproduto: id_produto },
        dataType: "json",
        success: function (response) {
            console.log(response)

            $('#body_tabela_ingredientes_comanda').empty()
            //Altera o valor do produto selecionado de acordo com o somatorio dos ingredientes
            $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + response['valorproduto'].toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
            $('#valortotal').replaceWith('<input id="valortotal" class="form-control" hidden value="' + response['valorproduto'] + '"></input>');

            nomeproduto = response['nomeproduto']

            listaIngredientesProduto = response[0].ingredientes

            valor_adicional_total = 0

            porcaoextra = []

            ingredienteadicional = []

            removeringrediente = []

            //Monta a lista de ingredientes do produto
            $.each(listaIngredientesProduto, function (key, value) {

                $('#body_tabela_ingredientes_comanda').prepend('<tr><td>' + value['nome'] + '</td><td id="qtd_ing_' + value["idingrediente"] + '" value="' + value["quantidade"] + '"> ' + value['quantidade'] + 'x </td><td class="text-center"><a id="adc_ing_' + value['idingrediente'] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + value['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + value['idingrediente'] + '">' + (value['valoradicional']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>')



                //Método de adicionar ingrediente
                $('#adc_ing_' + value['idingrediente']).click(function (e) {
                    e.preventDefault();

                    value['quantidade']++

                    $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');

                    if (value['quantidade'] <= 0) {
                        value['quantidade'] = 0
                        $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');
                    } else if (value['quantidade'] == 1) {
                        // não adiciona nada ao valor total
                    } else {
                        porcaoextra.push({
                            'ingredienteporcaoextra': value['nome'],
                            'idporcaoextra': value['idingrediente'],
                            'qtdporcaoextra': value['quantidade']
                        })

                        valor_adicional_total = valor_adicional_total + value['valoradicional']

                        $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                    }
                });

                //Método de remover ingrediente
                $('#rmv_ing_' + value['idingrediente']).click(function (e) {
                    e.preventDefault();
                    value['quantidade']--


                    removeringrediente.push({
                        'removeringrediente': value['nome'],
                        'idremoveringrediente': value['idingrediente'],
                        'qtdremoveringrediente': value['quantidade']
                    })

                    if (value['quantidade'] <= 0) {
                        $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> 0x </td>');
                        value['quantidade'] = 0
                    } else {


                        $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');

                        valor_adicional_total = valor_adicional_total - value['valoradicional']

                        $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                    }
                });


            });
            //Cria botão para adição de novo ingredientes
            $('#body_tabela_ingredientes_comanda').append('<tr><th colspan="5" class="text-center"><input type="button" class="btn btn-dark "value="Adicionar outro ingrediente" id="adc_novo_ingrediente"></th></tr><tr id="linha_ing_adc" hidden><th colspan="5" class="text-center">INGREDIENTES ADICIONAIS</th></tr>')


            //Configura tela para adição de novo ingrediente, com ajax para buscar ingredientes
            $('#adc_novo_ingrediente').click(function (e) {
                e.preventDefault();

                $('#adc_novo_ingrediente').attr('hidden', true);
                $('#linha_ing_adc').attr('hidden', false);

                $.ajax({
                    type: "get",
                    url: "/ingredientes/ajax",
                    dataType: "json",
                    success: function (responseIngredientes) {//retorna todos os ingredientes

                        //Cria um select com os ingredientes cadastrados
                        $('#body_tabela_ingredientes_comanda').append('<tr id="linha_select_ingredientes"><th colspan="4" class="text-center"><select class="form-control" name="" id="select_adc_novo_ingrediente"></select> </th><th><button type="button" name="" id="btn_adc_novo_ingrediente_comanda" class="btn btn-dark"><i class="fa-solid fa-save"></i></button></th></tr>')


                        $('#select_adc_novo_ingrediente').empty();

                        //inclui as opções no select
                        for (let c = 0; c < responseIngredientes.length; c++) {

                            $('#select_adc_novo_ingrediente').prepend('<option id="option' + responseIngredientes[c].idingrediente + '" value="' + responseIngredientes[c].idingrediente + '">' + responseIngredientes[c].nomeingrediente + '</option>')
                            for (let index = 0; index < listaIngredientesProduto.length; index++) {//se o ingrediente já estiver no produto é removido
                                if (responseIngredientes[c].idingrediente == listaIngredientesProduto[index].idingrediente) {
                                    $('#option' + responseIngredientes[c].idingrediente).remove()
                                }
                            }
                        }



                        //Ao selecionar o ingrediente adicional, incluir na lista de ingredientes e adicionar o valor
                        $('#btn_adc_novo_ingrediente_comanda').click(function (e) {
                            e.preventDefault()
                            id_novo_ingrediente_comanda = $('#select_adc_novo_ingrediente').val()


                            //Monta as options do select com os ingredientes
                            for (let i = 0; i < responseIngredientes.length; i++) {

                                if (id_novo_ingrediente_comanda == responseIngredientes[i].idingrediente) {//compara se o id ingrediente do produto está na lista de ingredientes

                                    qtd = 1

                                    ingredienteadicional.push({
                                        'ingredienteadicional': responseIngredientes[i]['nomeingrediente'],
                                        'idingredienteadicional': responseIngredientes[i]['idingrediente'],
                                        'qtdingredienteadicional': qtd
                                    })

                                    $('#body_tabela_ingredientes_comanda').append('<tr><td>' + responseIngredientes[i]['nomeingrediente'] + '</td><td id="qtd_ing_' + responseIngredientes[i]["idingrediente"] + '"> ' + qtd + 'x </td><td class="text-center"><a id="adc_ing_' + responseIngredientes[i]["idingrediente"] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + responseIngredientes[i]['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + responseIngredientes[i]['idingrediente'] + '">' + responseIngredientes[i]['valoradicional'].toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>');

                                    valor_adicional_total = valor_adicional_total + responseIngredientes[i]['valoradicional']

                                    $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                                    $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');

                                    //Método de adicionar ingrediente
                                    $('#adc_ing_' + responseIngredientes[i]['idingrediente']).click(function (e) {
                                        e.preventDefault();
                                        qtd++

                                        $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> ' + qtd + 'x </td>');

                                        ingredienteadicional.push({
                                            'ingredienteadicional': responseIngredientes[i]['nomeingrediente'],
                                            'idingredienteadicional': responseIngredientes[i]['idingrediente'],
                                            'qtdingredienteadicional': qtd
                                        })

                                        if (qtd <= 0) {
                                            $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> 0x </td>');
                                            qtd = 0
                                        } else {
                                            vlr_total = (qtd * responseIngredientes[i]['valoradicional']) + response['valorproduto']

                                            valor_adicional_total = valor_adicional_total + responseIngredientes[i]['valoradicional']


                                            $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                                            $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                                        }
                                    });

                                    //Método de remover ingrediente
                                    $('#rmv_ing_' + responseIngredientes[i]['idingrediente']).click(function (e) {
                                        e.preventDefault();
                                        qtd--

                                        ingredienteadicional.push({
                                            'ingredienteadicional': responseIngredientes[i]['nomeingrediente'],
                                            'idingredienteadicional': responseIngredientes[i]['idingrediente'],
                                            'qtdingredienteadicional': qtd
                                        })


                                        if (qtd < 0) {
                                            alert('Não é possível ingrediente menor que ZERO!')
                                        } else {

                                            $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> ' + qtd + 'x </td>');

                                            vlr_total = (qtd * responseIngredientes[i]['valoradicional']) + response['valorproduto']

                                            valor_adicional_total = valor_adicional_total - responseIngredientes[i]['valoradicional']


                                        }
                                        $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                                    });

                                }


                            }


                            $('#adc_novo_ingrediente').attr('hidden', false);
                            $('#linha_select_ingredientes').replaceWith('');
                        })
                    }
                });

            });



        }
    });

    $('#tabela_ingredientes_comanda').attr('hidden', false)
});

produto = []
//inserção do produto na tabela de produtos da comanda
$('#salva_produto_comanda').click(function (e) {
    e.preventDefault();

    $('#tabela_produtos_lançados_na_comanda').empty();

    $('#tabela_ingredientes_comanda').attr('hidden', true)
    if (($('#select_produto_comanda').val()) != null) {
        produto.push({
            idproduto: $('#select_produto_comanda').val(),
            nomeproduto: nomeproduto,
            vladicional: valor_adicional_total,
            porcaoextra: porcaoextra,
            ingredienteadicional: ingredienteadicional,
            removeringrediente: removeringrediente,
            vlfinalproduto: parseFloat($('#valortotal').val())
        })

        for (let index = 0; index < produto.length; index++) {
            
            $('#tabela_produtos_lançados_na_comanda').append('<tr><td>' + produto[index].nomeproduto + '</td><td class="text-center">' + produto[index].vlfinalproduto.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td><td class="text-center"><button id="btn_remove_produto_comanda_' + produto[index].idproduto + '" class="btn fa-solid fa-trash-can text-danger"></button></td></tr>')
        }

        $('#tabela_produtos_lançados_na_comanda').attr('hidden', false);




        // valortotal = $('#valortotal').val()
        // nomecliente = $('#nomecliente').val()
        // idatendente = $('#select_atendente_comanda').val()
        // idmesa = $('#select_mesa_comanda').val()
        // produto = {
        //     idproduto: $('#select_produto_comanda').val(),
        //     vladicional: valor_adicional_total,
        //     porcaoextra: porcaoextra,
        //     ingredienteadicional: ingredienteadicional,            
        //     removeringrediente: removeringrediente
        // }

        // $.ajax({
        //     type: "POST",
        //     url: "/salvaprodutoeingredientescomanda/ajax",
        //     data: { 
        //         idcomanda: 0,
        //         valortotal: valortotal,
        //         statuscomanda: null,
        //         datacomanda: null,
        //         nomecliente: nomecliente,
        //         idatendente: idatendente,
        //         idmesa: idmesa,
        //         produto: produto
        //     },
        //     dataType: "json",
        //     success: function (response) {
        //         console.log(response)
        //     },
        //     error: function (err) {
        //         console.log(err)
        //     }
        // });

    }
    else {
        alert('Selecione um produto para incluir na comanda')
    }

    console.log(produto)


});





