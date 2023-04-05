window.onload = () => {
    $.ajax({
        type: "get",
        url: "/listacomandasajax",
        dataType: "json",
        success: function (response) {

            comandas = response

            console.log('comandas')
            console.log(comandas)

            for (let index = 0; index < comandas.length; index++) {

                $('#select_tipo_produto_comanda_' + comandas[index]['idcomanda']).change(function (e) {
                    e.preventDefault();

                    idtipo = $('#select_tipo_produto_comanda_' + comandas[index]['idcomanda']).val()

                    carregaOptionsComProduto(idtipo, comandas[index])
                });

                $('#select_produto_comanda_' + comandas[index]['idcomanda']).change(function (e) {
                    e.preventDefault();

                    idproduto = $('#select_produto_comanda_' + comandas[index]['idcomanda']).val()

                    carregaTabelaDeIngredientes(idproduto, comandas[index]['idcomanda'], comandas)
                });

            }
        }
    })

}

function carregaOptionsComProduto(idtipo, comandas) {
    $.ajax({
        type: "get",
        url: "/cardapio/ajax/tipo",
        data: { idtipo: idtipo },
        dataType: "json",
        success: function (response) {

            $('#select_produto_comanda_' + comandas['idcomanda']).empty()

            if (response.length == 0) {
                $('#select_produto_comanda_' + comandas['idcomanda']).prepend('<option selected disabled value="invalido">Não há produtos desse tipo </option>')
            }


            //Carrega os produtos de acordo com o tipo selecionado
            for (let index = 0; index < response.length; index++) {
                $('#select_produto_comanda_' + comandas['idcomanda']).prepend('<option value=' + response[index].idproduto + '>' + response[index].nomeproduto + ' - ' + (response[index].valorproduto).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</option>')
            }
            $('#select_produto_comanda_' + comandas['idcomanda']).prepend('<option selected disabled>Selecione o produto</option>')
        }
    });
}

function carregaTabelaDeIngredientes(idproduto, idcomanda, comandas) {

    $.ajax({
        type: "get",
        url: "/ingredientesproduto/ajax",
        data: { idproduto: idproduto },
        dataType: "json",
        success: function (response) {

            porcaoextra = []

            adicionais = []

            ingredienteadicional = []

            removeringrediente = []


            $('#body_tabela_ingredientes_produto_comanda_' + idcomanda).empty()

            exibeValorProdutoNaTabelaIngredientes(response['valorproduto'], idcomanda)

            $.map(response['ingredientes'], function (valor) {

                $('#body_tabela_ingredientes_produto_comanda_' + idcomanda).prepend('<tr><td>' + valor['nomeingrediente'] + '</td><td id="qtd_ing_' + valor["idingrediente"] + '" value="' + valor["quantidade"] + '"> ' + valor['quantidade'] + 'x </td><td class="text-center"><a id="adc_ing_' + valor['idingrediente'] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + valor['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + valor['idingrediente'] + '">' + (valor['valoradicional']).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>')
            });

            calculaEspecificacoesIngredientes(response['ingredientes'], idcomanda)

            //Cria botão para adicão de novo ingredientes
            $('#body_tabela_ingredientes_produto_comanda_' + idcomanda).append('<tr><th colspan="5" class="text-center"><input type="button" class="btn btn-dark "value="Adicionar outro ingrediente" id="adc_novo_ingrediente_comanda_' + idcomanda + '"></th></tr><tr id="linha_ing_adc" hidden><th colspan="5" class="text-center">INGREDIENTES ADICIONAIS</th></tr>')

            //evento de adicao de novos ingredientes
            $('#adc_novo_ingrediente_comanda_' + idcomanda).click(function (e) {
                e.preventDefault();

                $('#adc_novo_ingrediente_comanda_' + idcomanda).attr('hidden', true);
                $('#linha_ing_adc').attr('hidden', false);

                $.ajax({
                    type: "get",
                    url: "/ingredientes/ajax",
                    dataType: "json",
                    success: function (todosIngredientes) {

                        //Cria um select com os ingredientes cadastrados
                        $('#body_tabela_ingredientes_produto_comanda_' + idcomanda).append('<tr id="linha_select_ingredientes"><th colspan="4" class="text-center"><select class="form-control" name="" id="select_adc_novo_ingrediente"></select> </th><th><button type="button" name="" id="btn_adc_novo_ingrediente_comanda_' + idcomanda + '" class="btn btn-dark"><i class="fa-solid fa-save"></i></button></th></tr>')


                        $('#select_adc_novo_ingrediente').empty();

                        //inclui as opcões no select
                        for (let c = 0; c < todosIngredientes.length; c++) {

                            $('#select_adc_novo_ingrediente').prepend('<option id="option' + todosIngredientes[c].idingrediente + '" value="' + todosIngredientes[c].idingrediente + '">' + todosIngredientes[c].nomeingrediente + ' - ' + (todosIngredientes[c].valoradicional).toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</option>')
                            for (let index = 0; index < response['ingredientes'].length; index++) {//se o ingrediente já estiver no produto é removido
                                if (todosIngredientes[c].idingrediente == response['ingredientes'][index].idingrediente) {
                                    $('#option' + todosIngredientes[c].idingrediente).remove()
                                }
                            }
                        }



                        //Ao selecionar o ingrediente adicional, incluir na lista de ingredientes e adicionar o valor
                        $('#btn_adc_novo_ingrediente_comanda_' + idcomanda).click(function (e) {
                            e.preventDefault()
                            id_novo_ingrediente_comanda = $('#select_adc_novo_ingrediente').val()


                            //Monta as options do select com os ingredientes
                            for (let i = 0; i < todosIngredientes.length; i++) {

                                if (id_novo_ingrediente_comanda == todosIngredientes[i].idingrediente) {

                                    qtd = 1

                                    todosIngredientes[i].qtdingredienteadicional = qtd

                                    $('#body_tabela_ingredientes_produto_comanda_' + idcomanda).append('<tr><td>' + todosIngredientes[i]['nomeingrediente'] + '</td><td id="qtd_ing_' + todosIngredientes[i]["idingrediente"] + '"> ' + qtd + 'x </td><td class="text-center"><a id="adc_ing_' + todosIngredientes[i]["idingrediente"] + '" href=""><i class="fa-solid fa-circle-plus text-success fa-2x"></i></a></td><td class="text-center"><a id="rmv_ing_' + todosIngredientes[i]['idingrediente'] + '" href=""><i class="fa-solid fa-circle-minus text-warning fa-2x"></i></a></td><td id="vlr_adc_' + todosIngredientes[i]['idingrediente'] + '">' + todosIngredientes[i]['valoradicional'].toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '</td></tr>');

                                    valor_adicional_total = valor_adicional_total + todosIngredientes[i]['valoradicional']

                                    exibeValorProdutoNaTabelaIngredientes((valor_adicional_total + response['valorproduto']), idcomanda)

                                    //Método de adicionar ingrediente
                                    $('#adc_ing_' + todosIngredientes[i]['idingrediente']).click(function (e) {
                                        e.preventDefault();
                                        qtd++

                                        $('#qtd_ing_' + todosIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + todosIngredientes[i]['idingrediente'] + '"> ' + qtd + 'x </td>');

                                        if (qtd <= 0) {
                                            $('#qtd_ing_' + todosIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + todosIngredientes[i]['idingrediente'] + '"> 0x </td>');
                                            qtd = 0
                                        } else {
                                            vlr_total = (qtd * todosIngredientes[i]['valoradicional']) + response['valorproduto']

                                            valor_adicional_total = valor_adicional_total + todosIngredientes[i]['valoradicional']

                                            exibeValorProdutoNaTabelaIngredientes((valor_adicional_total + response['valorproduto']), idcomanda)
                                        }

                                        todosIngredientes[i].qtdingredienteadicional = qtd
                                    });

                                    //Método de remover ingrediente
                                    $('#rmv_ing_' + todosIngredientes[i]['idingrediente']).click(function (e) {
                                        e.preventDefault();

                                        qtd--

                                        if (qtd < 0) {
                                            alert('Não é possível ingrediente menor que ZERO!')
                                        } else {

                                            $('#qtd_ing_' + todosIngredientes[i]['idingrediente']).replaceWith('<td id="qtd_ing_' + todosIngredientes[i]['idingrediente'] + '"> ' + qtd + 'x </td>');

                                            vlr_total = (qtd * todosIngredientes[i]['valoradicional']) + response['valorproduto']

                                            valor_adicional_total = valor_adicional_total - todosIngredientes[i]['valoradicional']

                                            todosIngredientes[i].qtdingredienteadicional = qtd

                                        }

                                        exibeValorProdutoNaTabelaIngredientes((valor_adicional_total + response['valorproduto']), idcomanda)
                                    });

                                    adicionais.push(todosIngredientes[i])
                                }
                            }


                            $('#adc_novo_ingrediente_comanda_' + idcomanda).attr('hidden', false);
                            $('#linha_select_ingredientes').replaceWith('');
                        })
                    }
                });

            });



            $('#tabela_ingredientes_comanda_' + idcomanda).attr('hidden', false)
            $('#txt_observacao_' + idcomanda).attr('hidden', false);

            salvaProdutoComandaEdit(idproduto, response['ingredientes'], idcomanda, response['nomeproduto'])

        }
    })

}

function exibeValorProdutoNaTabelaIngredientes(valorProduto, idcomanda) {

    $('#valortotal_exibido_tabela_ingredientes_comanda_' + idcomanda).replaceWith('<input id="valortotal_exibido_tabela_ingredientes_comanda_' + idcomanda + '" class="form-control text-center" disabled value="' + valorProduto.toLocaleString("pt-BR", { style: "currency", currency: "BRL" }) + '"></input>');
    $('#valortotal').replaceWith('<input id="valortotal" class="form-control" hidden value="' + valorProduto + '"></input>');

}

function calculaEspecificacoesIngredientes(ingredientes, idcomanda) {

    adicionarIngredienteProdutoComanda(ingredientes, idcomanda)

    removerIngredienteProdutoComanda(ingredientes, idcomanda)

}

function adicionarIngredienteProdutoComanda(ingredientes, idcomanda) {

    valor_adicional_total = 0

    $.map(ingredientes, function (value) {
        $('#adc_ing_' + value['idingrediente']).click(function (e) {
            e.preventDefault();

            console.log('quantidade' + value['nomeingrediente'])
            console.log(value['quantidade'])

            value['quantidade']++

            $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');

            if (value['quantidade'] <= 0) {
                value['quantidade'] = 0
                $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');
            } else if (value['quantidade'] == 1) {
                // não adiciona nada ao valor total
            } else {
                valor_adicional_total = valor_adicional_total + value['valoradicional']

                exibeValorProdutoNaTabelaIngredientes((value['valorproduto'] + valor_adicional_total), idcomanda)

                ingredienteporcaoextra = value['nomeingrediente']
                idporcaoextra = value['idingrediente']
                qtdporcaoextra = value['quantidade']
            }
        });

    });


}

function removerIngredienteProdutoComanda(ingredientes, idcomanda) {

    $.map(ingredientes, function (value) {

        $('#rmv_ing_' + value['idingrediente']).click(function (e) {
            e.preventDefault();
            value['quantidade']--

            if (value['quantidade'] <= 0) {
                $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> 0x </td>');
                value['quantidade'] = 0
            } else {

                $('#qtd_ing_' + value['idingrediente']).replaceWith('<td id="qtd_ing_' + value['idingrediente'] + '"> ' + value['quantidade'] + 'x </td>');

                valor_adicional_total = valor_adicional_total - value['valoradicional']

                exibeValorProdutoNaTabelaIngredientes((valor_adicional_total + value['valorproduto']), idcomanda)
            }
        });

    });

}

function salvaProdutoComandaEdit(idproduto, listaIngredientesProduto, idcomanda, nomeproduto) {
    $('.atualiza_comanda_' + idcomanda).click(function (e) {
        e.preventDefault();

        txtvlinicialcomanda = $('#valor_total_comanda_' + idcomanda).text()
        vlinicialcomanda = parseFloat(txtvlinicialcomanda.replace('R$ ', '').replace('.', '').replace(',', '.'))
        nroitem = $('#body_tabela_produtos_lancados_na_comanda_' + idcomanda + ' tr').length

        $.each(listaIngredientesProduto, function (key, value) {
            if (value['quantidade'] > 1) {
                porcaoextra.push({
                    'ingredienteporcaoextra': value['nomeingrediente'],
                    'idproduto': idproduto,
                    'idingrediente': value['idingrediente'],
                    'qtdporcaoextra': value['quantidade'],
                    'nroitem': nroitem
                })
            }

            if (value['quantidade'] == 0) {
                removeringrediente.push({
                    'removeringrediente': value['nomeingrediente'],
                    'idproduto': idproduto,
                    'idingrediente': value['idingrediente'],
                    'nroitem': nroitem
                })
            }
        });

        $.each(adicionais, function (key, value) {
            ingredienteadicional.push({
                'ingredienteadicional': value['nomeingrediente'],
                'idproduto': idproduto,
                'idingrediente': value['idingrediente'],
                'qtdingredienteadicional': value['qtdingredienteadicional'],
                'nroitem': nroitem
            })
        });

        txtvlprodutoadicionado = $('#valortotal_exibido_tabela_ingredientes_comanda_' + idcomanda).val()
        vlprodutoadicionado = parseFloat(txtvlprodutoadicionado.replace('R$', '').replace('.', '').replace(',', '.'))

        produtos.push({
            idproduto: idproduto,
            nomeproduto: nomeproduto,
            vladicional: valor_adicional_total,
            porcaoextra: porcaoextra,
            ingredienteadicional: ingredienteadicional,
            removeringrediente: removeringrediente,
            observacao: $('#txt_observacao_' + idcomanda).val(),
            vlfinalproduto: vlprodutoadicionado,
            nroitem: nroitem
        })

        porcaoextra = []
        ingredienteadicional = []
        removeringrediente = []

        vlfinalcomanda = vlprodutoadicionado + vlinicialcomanda

        $.ajax({
            type: "POST",
            url: "/salvaprodutoeingredientescomanda/ajax",
            data: {
                idcomanda: idcomanda,
                valortotal: vlfinalcomanda,
                statuscomanda: null,
                datacomanda: null,
                idcartao: $('#select_cartao_editar_comanda_' + idcomanda).val(),
                nomecliente: $('#nomecliente_comanda_' + idcomanda).val(),
                idatendente: $('#select_atendente_comanda_' + idcomanda).val(),
                idmesa: $('#select_mesa_comanda_' + idcomanda).val(),
                idcomandamesa: $('#idcomandamesa_'+idcomanda).val(),
                observacao: $('#txt_observacao_' + idcomanda).val(),
                produtos: produtos
            },
            dataType: "json",
            success: function (response) {
                console.log('response:')
                console.log(response)
                document.location.reload()
            },
            error: function (err) {
                console.log('erro')
                console.log(err)
            }
        });

        $('#txt_observacao_' + idcomanda).val('')

    });

}



