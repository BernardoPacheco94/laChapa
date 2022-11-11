
// Envia o formulário de pesquisa por tipo de produto ao carregar a pagina
$(document).ready(function () {
    $('#form_cardapio_pesquisa_por_tipo').submit()
});


// Envia o formulário de pesquisa por tipo de produto ao alterar o tipo de produto
$('#select_tipo').change(function () {
    $('#form_cardapio_pesquisa_por_tipo').submit()
});


//Carregamento das opções de produto via ajax || Cadastro de produtos
$('#form_cardapio_pesquisa_por_tipo').submit(function (e) {
    e.preventDefault();

    var id_tipo = $('#select_tipo').val()
    var pesquisa = $('#pesquisar').val()


    $.ajax({
        type: "get",
        url: "/cardapio/ajax/tipo",
        data: { idtipo: id_tipo, pesquisa: pesquisa },
        dataType: "json",
        error: function (err) {
            console.log(err)
        },
        success: function (response) {
            $('#produtos_tbody').empty();

            console.log(response)

            //carrega a tabela de produtos de acordo com o ingrediente
            for (let i = 0; i < response.length; i++) {

                $('#produtos_tbody').prepend('<tr><th scope="row" class="text-center">' + response[i].idproduto + '</th><td>' + response[i].nometipo + '</td><td>' + response[i].nomeproduto + '</td><td><ul id="ingredientes' + response[i].idproduto + '" class="list-group list-group-horizontal"> </ul></td><td> ' + (response[i].valorproduto).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td><td class="text-center"><button class="btn" data-bs-toggle="modal"data-bs-target="#modalEditarProduto' + response[i].idproduto + '"><i class="fa-solid fa-2x fa-edit text-info"></i></button></td><td class="text-center"><a id="deletar_produto' + response[i].idproduto + '" href="/produto/deletar/' + response[i].idproduto + '"><i class="fa-solid fa-2x fa-trash-can text-danger"></i></a></td></tr>');

                //Confirmação de exclusão
                $('#deletar_produto' + response[i].idproduto).click(function (e) {

                    return confirm("Deseja realmente excluir o produto " + response[i].nomeproduto + " ?")

                });


                list = response[i][0].ingredientes.ingredientes //Lista de ingredientes do produto

                //Carrega os ingredientes do produto selecionado
                $.each(list, function (key, value) {
                    $('#ingredientes' + response[i].idproduto).append($('<li class="list-group-item">' + value['nome'] + '</li>'))
                });

            }
        }
    });


});

//Carregamento das opções da comanda via ajax
$('#select_tipo_produto_comanda').change(function (e) {
    e.preventDefault();

    id_tipo = $('#select_tipo_produto_comanda').val()

    $.ajax({
        type: "get",
        url: "/cardapio/ajax/tipo",//mesma rota do ajax anterior
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

        }
    });

});


//Carregamento dos ingredientes do produdo na comanda, após selecionar o produto
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

            $('#tabela_ingredientes_comanda').empty()
            //Altera o valor do produto selecionado de acordo com o somatorio dos ingredientes
            $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + response['valorproduto'].toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
            $('#valortotal').replaceWith('<input id="valortotal" class="form-control" hidden value="' + response['valorproduto'] + '"></input>');

            listaIngredientesProduto = response[0].ingredientes

            valor_adicional_total = 0

            //Monta a lista de ingredientes do produto
            $.each(listaIngredientesProduto, function (key, value) {

                $('#tabela_ingredientes_comanda').prepend('<tr><td>' + value['nome'] + '</td><td id="qtd_ing_' + value["idingrediente"] + '" value="'+value["quantidade"]+'"> ' + value['quantidade'] + 'x </td><td class="text-center"><a id="adc_ing_' + value['idingrediente'] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + value['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + value['idingrediente'] + '">' + (value['valoradicional']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>')

                //Método de adicionar ingrediente
                $('#adc_ing_' + value['idingrediente']).click(function (e) {
                    e.preventDefault();
                    
                    value['quantidade']++

                    $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');

                    if (value['quantidade'] <= 0) {
                        value['quantidade'] = 0
                        $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> '+value['quantidade']+'x </td>');
                    } else if(value['quantidade'] == 1){
                        // não adiciona nada ao valor total
                    } else {
                        valor_adicional_total = valor_adicional_total + value['valoradicional']

                        $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + (valor_adicional_total+response['valorproduto']) + '">');

                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (valor_adicional_total+response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                        console.log(valor_adicional_total)

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

                        $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (valor_adicional_total + response['valorproduto']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                    }
                });


            });
            //Cria botão para adição de novo ingredientes
            $('#tabela_ingredientes_comanda').append('<tr><th colspan="5" class="text-center"><input type="button" class="btn btn-dark "value="Adicionar outro ingrediente" id="adc_novo_ingrediente"></th></tr>')


            //Configura tela para adição de novo ingrediente, com ajax para buscar ingredientes
            $('#adc_novo_ingrediente').click(function (e) {
                e.preventDefault();

                $('#adc_novo_ingrediente').attr('hidden', true);

                $.ajax({
                    type: "get",
                    url: "/ingredientes/ajax",
                    dataType: "json",
                    success: function (responseIngredientes) {//retorna todos os ingredientes
                        console.log(responseIngredientes)

                        //Cria um select com os ingredientes cadastrados
                        $('#tabela_ingredientes_comanda').append('<tr id="linha_select_ingredientes"><th colspan="4" class="text-center"><select class="form-control" name="" id="select_adc_novo_ingrediente"></select> </th><th><button type="button" name="" id="btn_adc_novo_ingrediente_comanda" class="btn btn-dark"><i class="fa-solid fa-save"></i></button></th></tr>')


                        $('#select_adc_novo_ingrediente').empty();

                        //inclui as opções no select
                        for (let c = 0; c < responseIngredientes.length; c++) {
                            $('#select_adc_novo_ingrediente').prepend('<option value="' + responseIngredientes[c].idingrediente + '">' + responseIngredientes[c].nomeingrediente + '</option>')
                        }



                        //Ao selecionar o ingrediente adicional, incluir na lista de ingredientes e adicionar o valor
                        $('#btn_adc_novo_ingrediente_comanda').click(function (e) {
                            e.preventDefault()
                            id_novo_ingrediente_comanda = $('#select_adc_novo_ingrediente').val()


                            //Monta as options do select com os ingredientes
                            for (let i = 0; i < responseIngredientes.length; i++) {

                                if (id_novo_ingrediente_comanda == responseIngredientes[i].idingrediente) {//compara se o id ingrediente do produto está na lista de ingredientes

                                    qtd = 1
                                    

                                    $('#tabela_ingredientes_comanda').prepend('<tr><td>' + responseIngredientes[i]['nomeingrediente'] + '</td><td id="qtd_ing_' + responseIngredientes[i]["idingrediente"] + '"> '+qtd+'x </td><td class="text-center"><a id="adc_ing_' + responseIngredientes[i]["idingrediente"] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + responseIngredientes[i]['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + responseIngredientes[i]['idingrediente'] + '">' + responseIngredientes[i]['valoradicional'].toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>');

                                    //Método de adicionar ingrediente
                                    $('#adc_ing_' + responseIngredientes[i]['idingrediente']).click(function (e) {
                                        e.preventDefault();
                                        qtd++
                                        console.log('qtd: ' + qtd)


                                        $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> ' + qtd + 'x </td>');

                                        if (qtd <= 0) {
                                            $('#qtd_ing_' + responseIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + responseIngredientes[i]['idingrediente'] + '"> 0x </td>');
                                            qtd = 0
                                        } else {
                                            vlr_total = (qtd * responseIngredientes[i]['valoradicional']) + response['valorproduto']
                                            

                                            $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + vlr_total + '">');

                                            $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + vlr_total.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                                        }
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
                                            console.log('qtd clicado: '+(qtd))
                                            console.log('valoradicional: '+responseIngredientes[i]['valoradicional'])
                                            console.log('valorproduto: '+response['valorproduto'])
                                            console.log('vlt_total: '+vlr_total)
                                            

                                            $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + vlr_total + '">');

                                            $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + vlr_total.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
                                        }
                                    });

                                    $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' +  + 'VERIFICAR">');

                                    $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + (10).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + 'VERIFICAR"></input>');
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
});

//desuso
// function adicionarERemoverIngredientesComanda(idIngrediente, qtd, valoradicional, valorproduto) {
//     $('#adc_ing_' + idIngrediente).click(function (e) {
//         e.preventDefault();
//         (qtd)++


//         $('#qtd_ing_' + idIngrediente).replaceWith('<td id="qtd_ing_' + idIngrediente + '"> ' + qtd + 'x </td>');

//         if (qtd <= 0) {
//             $('#qtd_ing_' + idIngrediente).replaceWith('<td id="qtd_ing_' + idIngrediente + '"> 0x </td>');
//             qtd = 1
//         } else {
//             vlr_total = ((qtd - 1) * valoradicional) + valorproduto

//             $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + vlr_total + '">');

//             $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + vlr_total.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');

//         }
//     });

//     $('#rmv_ing_' + idIngrediente).click(function (e) {
//         e.preventDefault();
//         (qtd)--


//         if (qtd <= 0) {
//             $('#qtd_ing_' + idIngrediente).replaceWith('<td id="qtd_ing_' + idIngrediente + '"> 0x </td>');
//             qtd = 0
//         } else {

//             $('#qtd_ing_' + idIngrediente).replaceWith('<td id="qtd_ing_' + idIngrediente + '"> ' + qtd + 'x </td>');

//             vlr_total = ((qtd - 1) * valoradicional) + valorproduto




//             $('#valortotal').replaceWith('<input type="number" step="0.01" name="valortotal" id="valortotal" class="form-control" hidden value="' + vlr_total + '">');

//             $('#valortotal_exibido').replaceWith('<input id="valortotal_exibido" class="form-control" disabled value="' + vlr_total.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
//         }
//     });

//     return valorproduto
// }




