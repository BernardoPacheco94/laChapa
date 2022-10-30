// $('#select_tipo_produto').change(function (e) { 
//     e.preventDefault()
//     var id_tipo = $(this).val()
//     console.log(id_tipo)

//     $.ajax({
//         type: "get",
//         url: "/teste/",
//         data: {select_tipo_produto: id_tipo},
//         dataType: "json",
//         success: function (response) {
//             console.log(response)
//         }
//     })
// })



$('#select_tipo').change(function () {
    $('#form_cardapio_pesquisa_por_tipo').submit()
});

$('#form_cardapio_pesquisa_por_tipo').submit(function (e) {
    e.preventDefault();

    var id_tipo = $('#select_tipo').val()
    var pesquisa = $('#pesquisar').val()
    // console.log(id_tipo, pesquisa)


    $.ajax({
        type: "get",
        url: "/cardapio/ajax",
        data: { idtipo: id_tipo, pesquisa: pesquisa },
        dataType: "json",
        error: function (err) {
            console.log(err)
        },
        success: function (response) {
            $('#produtos_tbody').empty();

            // console.log(response)
            for (let i = 0; i < response.length; i++) {
                // console.log(response[i][0])

                $('#produtos_tbody').prepend('<tr><th scope="row" class="text-center">' + response[i].idproduto + '</th><td>' + response[i].nometipo + '</td><td>' + response[i].nomeproduto + '</td><td><ul id="ingredientes' + response[i].idproduto + '" class="list-group list-group-horizontal"> </ul></td><td>R$ {function="formatPrice(' + response[i].valorproduto + ')"}</td><td class="text-center"><button class="btn" data-bs-toggle="modal"data-bs-target="#modalEditarProduto' + response[i].idproduto + '"><i class="fa-solid fa-2x fa-edit text-info"></i></button></td><td class="text-center"><a href="/produto/deletar/' + response[i].idproduto + '"onclick="return confirm("Deseja realmente excluir o produto ' + response[i].nomeproduto + '?")"><i class="fa-solid fa-2x fa-trash-can text-danger"></i></a></td></tr>');


                list = response[i][0].ingredientes

                list.forEach(element => {
                    console.log(element)
                    $('#ingredientes' + response[i].idproduto).append($('<li class="list-group-item">' + element + '</li>'))
                });

            }
        }
    });

});
