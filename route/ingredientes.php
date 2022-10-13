<?php

use LaChapa\Model\Ingrediente;
use LaChapa\Page;

$app->config('debug',true);

$app->get('/ingredientes', function(){
    $listaIngredientes = (isset($_GET['pesquisar'])) ? Ingrediente::pesquisar($_GET['pesquisar']) : Ingrediente::listaIngredientes();    
    
    $page = new Page();

    $page->setTpl('ingredientes',[
        'ingredientes'=>$listaIngredientes
    ]);
});


//adiciona novo ingrediente
$app->get('/addIngrediente', function(){
    $ingrediente = new Ingrediente;

    $ingrediente->setData($_GET);

    $ingrediente->salvaIngrediente();

    header('Location: /ingredientes');
    exit;
});

//deleta um ingrediente
$app->get('/ingrediente/deletar/:idingrediente', function($idingrediente){
    $ingrediente = new Ingrediente;

    $ingrediente->deletarIngrediente($idingrediente);

    header('Location: /ingredientes');
    exit;
});

//editar ingrediente
$app->get('/editarIngrediente/:idingrediente', function($idingrediente){
    $ingrediente = new Ingrediente;

    $ingrediente->setData($_GET);

    $ingrediente->updateIngrediente($idingrediente);

    header('Location: /ingredientes');
    exit;
});


