<?php

use LaChapa\Model\Tipo;
use LaChapa\Model\User;
use LaChapa\Page;

//Criar um tipo de produto
$app->get('/addTipo', function(){
    User::checkLogin();

    $tipo = new Tipo;

    $tipo->setData($_GET);

    $tipo->salvaTipo();

    header('Location: /tipos');
    exit;
});

//Visualizar tipos
$app->get('/tipos', function(){
    User::checkLogin();

    $listaTipos = (isset($_GET['pesquisar'])) ? Tipo::pesquisar($_GET['pesquisar']) : Tipo::listaTipos();    
    
    $page = new Page();

    $page->setTpl('tipos',[
        'tipos'=> $listaTipos
    ]);
});

// deletar tipo
$app->get('/tipos/deletar/:idtipo', function($idtipo){
    User::checkLogin();

    $tipo = new Tipo;

    $tipo->deletarTipo($idtipo);

    header('Location: /tipos');
    exit;
});

//editar tipo
$app->get('/editarTipo/:idtipo', function($idtipo){
    User::checkLogin();
    
    $tipo = new Tipo();

    $tipo->setData($_GET);

    $tipo->updateTipo($idtipo);

    header('Location: /tipos');
    exit;
});