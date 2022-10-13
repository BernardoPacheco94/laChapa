<?php

use LaChapa\Model\Ingrediente;
use LaChapa\Model\Produto;
use LaChapa\Model\Tipo;
use LaChapa\Page;

//pagina principal - visualizar produtos
$app->get('/cardapio', function(){
    $page = new Page();

    $page->setTpl('cardapio',[
        'tipos'=>Tipo::listaTipos(),
        'ingredientes'=>Ingrediente::listaIngredientes()
    ]);
});

//salvar produto
$app->get('/salvaProduto', function(){
    
    $produto = new Produto;
    $dataProduto = [];
    array_push($dataProduto, $_GET['nomeproduto'], $_GET['valorproduto']);
    $produto->setData($_GET);
    // var_dump($produto);
    // exit;
    $produto->salvaProduto();

    $produto->addTipo((int)$_GET['idtipo']);

    // if(isset($_GET['ingredientes']))
    // {
    //     $listaIngredientes = $_GET['ingredientes'];
    //     foreach ($listaIngredientes as $idingrediente) {
    //         $produto->addTipo((int)$idingrediente);
    //     }
    // }
    
    header('Location: /cardapio');
    exit;
});
