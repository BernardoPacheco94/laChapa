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
