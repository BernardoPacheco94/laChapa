<?php

use LaChapa\Model\Ingrediente;
use LaChapa\Model\Tipo;
use LaChapa\Model\User;
use LaChapa\Page;

$app->config('debug',true);

$app->get('/ingredientes', function(){
    User::checkLogin();

    $listaIngredientes = (isset($_GET['pesquisar'])) ? Ingrediente::pesquisar($_GET['pesquisar']) : Ingrediente::listaIngredientes();    
    
    $page = new Page();

    $page->setTpl('ingredientes',[
        'ingredientes'=>$listaIngredientes,
        'tipos'=>Tipo::listaTipos()
    ]);
});


//adiciona novo ingrediente
$app->get('/addIngrediente', function(){
    User::checkLogin();

    $ingrediente = new Ingrediente;

    $ingrediente->setData($_GET);

    $ingrediente->salvaIngrediente();

    header('Location: /ingredientes');
    exit;
});

//deleta um ingrediente
$app->get('/ingrediente/deletar/:idingrediente', function($idingrediente){
    User::checkLogin();

    $ingrediente = new Ingrediente;

    $ingrediente->deletarIngrediente($idingrediente);

    header('Location: /ingredientes');
    exit;
});

//editar ingrediente
$app->get('/editarIngrediente/:idingrediente', function($idingrediente){
    User::checkLogin();
    
    $ingrediente = new Ingrediente;

    $ingrediente->setData($_GET);

    $ingrediente->updateIngrediente($idingrediente);

    header('Location: /ingredientes');
    exit;
});


