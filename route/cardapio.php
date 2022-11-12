<?php

use LaChapa\Model\Ingrediente;
use LaChapa\Model\Produto;
use LaChapa\Model\Tipo;
use LaChapa\Page;

//pagina principal - visualizar produtos
$app->get('/cardapio', function(){   
    $produto = new Produto;
    
    $page = new Page();

    // if(isset($_GET['idtipo']))
    // {
    //     $listaProdutos = ($_GET['idtipo'] == 'todos') ? $listaProdutos = $produto->listaProdutos() : Produto::filtraPorTipo((int)$_GET['idtipo']);
    // } else if ((isset($_GET['pesquisar']))) {
    //     $listaProdutos = Produto::pesquisar($_GET['pesquisar']) ;
    // } else {
    //     $listaProdutos = $produto->listaProdutos();
    // }



    
    $page->setTpl('cardapio',[
        'tipos'=>Tipo::listaTipos(),
        'ingredientes'=>Ingrediente::listaIngredientes(),
        'produtos'=> Produto::listaProdutos()
    ]);
});
    


$app->get('/cardapio/ajax/tipo', function(){

    $idtipo = ($_GET['idtipo'] == 'todos' || $_GET['idtipo'] == '') ? '%' : ((int)$_GET['idtipo']);

    // $pesquisa = $_GET['pesquisa'];

    echo json_encode(Produto::filtraPorTipo($idtipo));

});

// $app->get('/cardapio/ajax/pesquisar', function(){
//     $pesquisa = $_GET['pesquisa'];

//     echo json_encode(Produto::pesquisar($pesquisa));

// });


//salvar produto
$app->get('/salvaProduto', function(){
    
    $produto = new Produto;
    $produto->setData($_GET);
    $produto->salvaProduto();

    $tipo = new Tipo;
    $tipo->get((int)$produto->getidtipo());
    

    $produto->addTipo($tipo);

    if(isset($_GET['ingredientes']))
    {
        $listaIngredientes = $_GET['ingredientes'];
        foreach ($listaIngredientes as $idingrediente) {
            $produto->addIngrediente((int)$idingrediente);
        }
    }
    
    header('Location: /cardapio');
    exit;
});

//excluir produto
$app->get('/produto/deletar/:idproduto', function($idproduto){
    $produto = new Produto;
    
    $produto->deletarProduto($idproduto);

    header('Location: /cardapio');
    exit;
});

//editar produto
$app->get('/editarProduto/:idproduto', function($idproduto){
    $produto = new Produto;

    $produto->setData($_GET);
    $produto->salvaProduto();

    $tipo = new Tipo;
    $tipo->get((int)$produto->getidtipo());
    
    $produto->updateTipo($produto->getidproduto());

    $produto->limpaIngredientes($produto->getidproduto());

    if(isset($_GET['ingredientes']))
    {
        $listaIngredientes = $_GET['ingredientes'];
        foreach ($listaIngredientes as $idingrediente) {
            $produto->addIngrediente((int)$idingrediente);
        }
    }

    header('Location: /cardapio');
    exit;
});
 