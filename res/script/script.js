
//Carregamento dos produtos
$('.select_tipo_produto_comanda').change(function (e) {
    e.preventDefault();

    id_tipo = $('.select_tipo_produto_comanda').val()

    $.ajax({
        type: "get",
        url: "/cardapio/ajax/tipo",
        data: { idtipo: id_tipo },
        dataType: "json",
        success: function (response) {

            $('.select_produto_comanda').empty()

            if (response.length == 0) {
                $('.select_produto_comanda').prepend('<option selected disabled value="invalido">Não há produtos desse tipo </option>')
            }


            //Carrega os produtos de acordo com o tipo selecionado
            for (let index = 0; index < response.length; index++) {
                $('.select_produto_comanda').prepend('<option value=' + response[index].idproduto + '>' + response[index].nomeproduto + '</option>')
            }
            $('.select_produto_comanda').prepend('<option selected disabled>Selecione o produto</option>')
        }
    });

});


//Carregamento dos ingredientes do produto na comanda
$('.select_produto_comanda').change(function (e) {
    e.preventDefault()

    id_produto = $('.select_produto_comanda').val()

    $.ajax({
        type: "get",
        url: "/ingredientesproduto/ajax",
        data: { idproduto: id_produto },
        dataType: "json",
        success: function (response) {
            console.log('response')
            console.log(response)
            $('#body_tabela_ingredientes_produto').empty()
            //Altera o valor do produto selecionado de acordo com o somatorio dos ingredientes, impedindo edição
            $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control text-center" disabled value="' + response['valorproduto'].toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
            $('#valortotal').replaceWith('<input id="valortotal" class="form-control" hidden value="' + response['valorproduto'] + '"></input>');

            nomeproduto = response['nomeproduto']

            listaIngredientesProduto = response.ingredientes

            valor_adicional_total = 0

            porcaoextra = []

            adicionais = []

            ingredienteadicional = []

            removeringrediente = []

            //Monta a lista de ingredientes do produto
            $.each(listaIngredientesProduto, function (key, value) {

                $('#body_tabela_ingredientes_produto').prepend('<tr><td>' + value['nomeingrediente'] + '</td><td id="qtd_ing_' + value["idingrediente"] + '" value="' + value["quantidade"] + '"> ' + value['quantidade'] + 'x </td><td class="text-center"><a id="adc_ing_' + value['idingrediente'] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + value['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + value['idingrediente'] + '">' + (value['valoradicional']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>')



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
                        valor_adicional_total = valor_adicional_total + value['valoradicional']

                        $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control text-center" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');

                        ingredienteporcaoextra = value['nomeingrediente']
                        idporcaoextra = value['idingrediente']
                        qtdporcaoextra = value['quantidade']
                    }
                });

                //Método de remover ingrediente
                $('#rmv_ing_' + value['idingrediente']).click(function (e) {
                    e.preventDefault();
                    value['quantidade']--

                    if (value['quantidade'] <= 0) {
                        $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> 0x </td>');
                        value['quantidade'] = 0
                    } else {


                        $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');

                        valor_adicional_total = valor_adicional_total - value['valoradicional']

                        $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control text-center" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                    }
                });


            });
            //Cria botão para adicão de novo ingredientes
            $('#body_tabela_ingredientes_produto').append('<tr><th colspan="5" class="text-center"><input type="button" class="btn btn-dark "value="Adicionar outro ingrediente" id="adc_novo_ingrediente"></th></tr><tr id="linha_ing_adc" hidden><th colspan="5" class="text-center">INGREDIENTES ADICIONAIS</th></tr>')


            //Configura tela para adicão de novo ingrediente, com ajax para buscar ingredientes
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
                        $('#body_tabela_ingredientes_produto').append('<tr id="linha_select_ingredientes"><th colspan="4" class="text-center"><select class="form-control" name="" id="select_adc_novo_ingrediente"></select> </th><th><button type="button" name="" id="btn_salva_novo_ingrediente_comanda" class="btn btn-dark"><i class="fa-solid fa-save"></i></button></th></tr>')


                        $('#select_adc_novo_ingrediente').empty();

                        //inclui as opcões no select
                        for (let c = 0; c < responseIngredientes.length; c++) {

                            $('#select_adc_novo_ingrediente').prepend('<option id="option' + responseIngredientes[c].idingrediente + '" value="' + responseIngredientes[c].idingrediente + '">' + responseIngredientes[c].nomeingrediente + '</option>')
                            for (let index = 0; index < listaIngredientesProduto.length; index++) {//se o ingrediente já estiver no produto é removido
                                if (responseIngredientes[c].idingrediente == listaIngredientesProduto[index].idingrediente) {
                                    $('#option' + responseIngredientes[c].idingrediente).remove()
                                }
                            }
                        }



                        //Ao selecionar o ingrediente adicional, incluir na lista de ingredientes e adicionar o valor
                        $('#btn_salva_novo_ingrediente_comanda').click(function (e) {
                            e.preventDefault()
                            id_novo_ingrediente_comanda = $('#select_adc_novo_ingrediente').val()


                            //Monta as options do select com os ingredientes
                            for (let i = 0; i < responseIngredientes.length; i++) {

                                if (id_novo_ingrediente_comanda == responseIngredientes[i].idingrediente) {

                                    qtd = 1

                                    responseIngredientes[i].qtdingredienteadicional = qtd

                                    $('#body_tabela_ingredientes_produto').append('<tr><td>' + responseIngredientes[i]['nomeingrediente'] + '</td><td id="qtd_ing_' + responseIngredientes[i]["idingrediente"] + '"> ' + qtd + 'x </td><td class="text-center"><a id="adc_ing_' + responseIngredientes[i]["idingrediente"] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + responseIngredientes[i]['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + responseIngredientes[i]['idingrediente'] + '">' + responseIngredientes[i]['valoradicional'].toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>');

                                    valor_adicional_total = valor_adicional_total + responseIngredientes[i]['valoradicional']

                                    $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                                    $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control text-center" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');

                                    //Método de adicionar ingrediente
                                    $('#adc_ing_' + responseIngredientes[i]['idingrediente']).click(function (e) {
                                        e.preventDefault();
                                        qtd++

                                        $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> ' + qtd + 'x </td>');

                                        if (qtd <= 0) {
                                            $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> 0x </td>');
                                            qtd = 0
                                        } else {
                                            vlr_total = (qtd * responseIngredientes[i]['valoradicional']) + response['valorproduto']

                                            valor_adicional_total = valor_adicional_total + responseIngredientes[i]['valoradicional']


                                            $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                                            $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control text-center" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                                        }

                                        responseIngredientes[i].qtdingredienteadicional = qtd
                                    });

                                    //Método de remover ingrediente
                                    $('#rmv_ing_' + responseIngredientes[i]['idingrediente']).click(function (e) {
                                        e.preventDefault();

                                        qtd--

                                        if (qtd < 0) {
                                            alert('Não é possível ingrediente menor que ZERO!')
                                        } else {

                                            $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> ' + qtd + 'x </td>');

                                            vlr_total = (qtd * responseIngredientes[i]['valoradicional']) + response['valorproduto']

                                            valor_adicional_total = valor_adicional_total - responseIngredientes[i]['valoradicional']

                                            responseIngredientes[i].qtdingredienteadicional = qtd

                                        }
                                        $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total + response['valorproduto']) + '">');

                                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control text-center" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                                    });

                                    adicionais.push(responseIngredientes[i])
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

//insercão do produto na tabela de produtos da comanda
produtos = []

function salvaProdutoComanda() {
    $('#salva_produto_comanda').click(function (e) {
        e.preventDefault();


        if (($('.select_produto_comanda').val()) != null) {
            $.each(listaIngredientesProduto, function (key, value) {
                if (value['quantidade'] > 1) {
                    porcaoextra.push({
                        'ingredienteporcaoextra': value['nomeingrediente'],
                        'idproduto': id_produto,
                        'idingrediente': value['idingrediente'],
                        'qtdporcaoextra': value['quantidade']
                    })
                }

                if (value['quantidade'] == 0) {
                    removeringrediente.push({
                        'removeringrediente': value['nomeingrediente'],
                        'idproduto': id_produto,
                        'idingrediente': value['idingrediente']
                    })
                }
            });

            $.each(adicionais, function (key, value) {
                ingredienteadicional.push({
                    'ingredienteadicional': value['nomeingrediente'],
                    'idproduto': id_produto,
                    'idingrediente': value['idingrediente'],
                    'qtdingredienteadicional': value['qtdingredienteadicional']
                })
            });

            produtos.push({
                idproduto: id_produto,
                nomeproduto: nomeproduto,
                vladicional: valor_adicional_total,
                porcaoextra: porcaoextra,
                ingredienteadicional: ingredienteadicional,
                removeringrediente: removeringrediente,
                vlfinalproduto: parseFloat($('#valortotal').val())
            })

            criaTabelaProdutosComanda(produtos);

        }
        else {
            alert('Selecione um produto para incluir na comanda')
        }
    });
}

function criaTabelaProdutosComanda(Array = produtos) {

    $('#body_tabela_produtos_lancados_na_comanda').empty();

    $('#tabela_ingredientes_comanda').attr('hidden', true)

    valortotalcomanda = 0

    $.map(produtos, function (key) {
        valortotalcomanda += key.vlfinalproduto
    });

    for (let index = 0; index < produtos.length; index++) {

        $('#tabela_produtos_lancados_na_comanda').append('<tr id="linha_produto_' + index + '"><td class="text-center"  id="td_nome_comanda_produto_' + index + '">' + produtos[index].nomeproduto + '</td><td class="text-center align-middle">' + produtos[index].vlfinalproduto.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td><td class="text-center align-middle"><button id="btn_remove_produto_comanda_' + index + '" class="btn fa-solid fa-trash-can text-danger "></button></td></tr>')


        //lista de ingredientes a serem removidos
        if ((produtos[index].removeringrediente).length) {
            $('#td_nome_comanda_produto_' + index).append('<ul class="text-start fw-normal" id="lista_remover_ingredientes_produto_' + index + '">Sem: </ul>')
            for (let i = 0; i < produtos[index].removeringrediente.length; i++) {
                $('#lista_remover_ingredientes_produto_' + index).append('<li>' + produtos[index].removeringrediente[i].removeringrediente + '</li>')
            }
        }

        //lista de porcões extras
        if (produtos[index].porcaoextra.length) {
            $('#td_nome_comanda_produto_' + index).append('<ul class="text-start fw-normal" id="lista_porcaoextra_ingredientes_produto_' + index + '">Porcão extra: </ul>')
            for (let i = 0; i < produtos[index].porcaoextra.length; i++) {
                $('#lista_porcaoextra_ingredientes_produto_' + index).append('<li>' + produtos[index].porcaoextra[i].ingredienteporcaoextra + ' - ' + produtos[index].porcaoextra[i].qtdporcaoextra + 'x</li>')
            }
        }

        //lista de ingredientes a serem adicionados
        if (produtos[index].ingredienteadicional.length) {

            $('#td_nome_comanda_produto_' + index).append('<ul class="text-start fw-normal" id="lista_ingredienteadicional_ingredientes_produto_' + index + '">Adicional: </ul>')

            for (let i = 0; i < produtos[index].ingredienteadicional.length; i++) {
                if (produtos[index].ingredienteadicional[i].qtdingredienteadicional >= 1) {
                    $('#lista_ingredienteadicional_ingredientes_produto_' + index).append('<li>' + produtos[index].ingredienteadicional[i].ingredienteadicional + ' - ' + produtos[index].ingredienteadicional[i].qtdingredienteadicional + 'x </li>')
                }
            }
        }

        //Evento para remover produto da tabela
        $('#btn_remove_produto_comanda_' + index).click(function (e) {
            e.preventDefault();
            // Remover item do array produto[] e atualizar o valor e afins
            produtos.splice(index, 1)
            $('#linha_produto_' + index).remove();

            criaTabelaProdutosComanda(produtos)

            exibeValorTotalComanda(valortotalcomanda)
        });

        exibeValorTotalComanda(valortotalcomanda)
    }


    $('#tabela_produtos_lancados_na_comanda').attr('hidden', false);

    $('.select_produto_comanda').prop('selectedIndex', 0)

}

function exibeValorTotalComanda(Float = valortotalcomanda) {
    $('#valortotal').replaceWith('<input id="valortotal" class="form-control" hidden value="' + valortotalcomanda + '"></input>');
    $('#valor_total_comanda').replaceWith('<th id="valor_total_comanda" class="text-start">' + valortotalcomanda.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</th>')
}

function salvaComanda(Array = produtos) {
    $('#salva_comanda').click(function (e) {
        e.preventDefault();

        if (($('#body_tabela_produtos_lancados_na_comanda').val()) != null) {

            valortotalcomanda = 0

            $.map(produtos, function (key) {
                valortotalcomanda += key.vlfinalproduto
            });

            $.ajax({
                type: "POST",
                url: "/salvaprodutoeingredientescomanda/ajax",
                data: {
                    idcomanda: 0,
                    valortotal: valortotalcomanda,
                    statuscomanda: null,
                    datacomanda: null,
                    nomecliente: $('.nome_cliente_nova_comanda').val(),
                    idatendente: $('.select_atendente_nova_comanda').val(),
                    idmesa: $('.select_mesa_nova_comanda').val(),
                    produtos: produtos
                },
                dataType: "json",
                success: function (response) {
                    console.log(response)

                    document.location.reload()
                },
                error: function (err) {
                    console.log(err)
                }
            });

        } else {
            alert('Selecione um produto para incluir na comanda')
        }

    });

}

salvaProdutoComanda()

salvaComanda(produtos) 