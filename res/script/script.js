$(document).ready(function () {
    $('#form_cardapio_pesquisa_por_tipo').submit()
});


$('#select_tipo').change(function () {
    $('#form_cardapio_pesquisa_por_tipo').submit()
});

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

            for (let i = 0; i < response.length; i++) {

                $('#produtos_tbody').prepend('<tr><th scope="row" class="text-center">' + response[i].idproduto + '</th><td>' + response[i].nometipo + '</td><td>' + response[i].nomeproduto + '</td><td><ul id="ingredientes' + response[i].idproduto + '" class="list-group list-group-horizontal"> </ul></td><td> ' + (response[i].valorproduto).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) + '</td><td class="text-center"><button class="btn" data-bs-toggle="modal"data-bs-target="#modalEditarProduto' + response[i].idproduto + '"><i class="fa-solid fa-2x fa-edit text-info"></i></button></td><td class="text-center"><a id="deletar_produto'+response[i].idproduto+'" href="/produto/deletar/' + response[i].idproduto + '"><i class="fa-solid fa-2x fa-trash-can text-danger"></i></a></td></tr>');

                $('#deletar_produto'+response[i].idproduto).click(function (e) { 
                    
                    return confirm("Deseja realmente excluir o produto "+response[i].nomeproduto+" ?")
                    
                });


                list = response[i][0].ingredientes

                list.forEach(element => {
                    $('#ingredientes' + response[i].idproduto).append($('<li class="list-group-item">' + element + '</li>'))
                });

            }
        }
    });

    // $.ajax({
    //     type: "get",
    //     url: "cardapio/ajax/pesquisar",
    //     data: {pesquisa: pesquisa},
    //     dataType: "json",
    //     success: function (response) {
    //         console.log(response)
            

    //         $('#produtos_tbody').empty();

    //         for (let i = 0; i < response.length; i++) {

    //             $('#produtos_tbody').prepend('<tr><th scope="row" class="text-center">' + response[i].idproduto + '</th><td>' + response[i].nometipo + '</td><td>' + response[i].nomeproduto + '</td><td><ul id="ingredientes' + response[i].idproduto + '" class="list-group list-group-horizontal"> </ul></td><td>R$ {function="formatPrice(' + response[i].valorproduto + ')"}</td><td class="text-center"><button class="btn" data-bs-toggle="modal"data-bs-target="#modalEditarProduto' + response[i].idproduto + '"><i class="fa-solid fa-2x fa-edit text-info"></i></button></td><td class="text-center"><a id="deletar_produto'+response[i].idproduto+'" href="/produto/deletar/' + response[i].idproduto + '"onclick="return confirm('+"Deseja realmente excluir o produto " + response[i].nomeproduto + '?)"><i class="fa-solid fa-2x fa-trash-can text-danger"></i></a></td></tr>');

    //             $('#deletar_produto'+response[i].idproduto).click(function (e) { 
                    
    //                 return confirm("Deseja realmente excluir o produto"+response[i].nomeproduto+" ?")
                    
    //             });


    //             list = response[i][0].ingredientes

    //             list.forEach(element => {
    //                 $('#ingredientes' + response[i].idproduto).append($('<li class="list-group-item">' + element + '</li>'))
    //             });

    //         }           
            
    //     }
    // });

});


