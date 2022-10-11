<?php

use LaChapa\Model\Tipo;
use LaChapa\Page;

//pagina principal - visualizar produtos
$app->get('/cardapio', function(){
    $page = new Page();

    $page->setTpl('cardapio');
});

//Criar um tipo de produto
$app->get('/addTipo', function(){
        
    $tipo = new Tipo;

    $tipo->setData($_GET);

    $tipo->salvaTipo();

    header('Location: /tipos');
    exit;
});

//Visualizar tipos
$app->get('/tipos', function(){
    $page = new Page();

    $page->setTpl('tipos',[
        'tipos'=>Tipo::listaTipos()
    ]);
});

// deletar tipo
$app->get('/tipos/deletar/:idtipo', function($idtipo){
    $tipo = new Tipo;

    $tipo->deletarTipo($idtipo);

    header('Location: /tipos');
    exit;
});

//editar tipo
$app->get('/editarTipo/:idtipo', function($idtipo){
    $tipo = new Tipo();

    $tipo->setData($_GET);

    $tipo->updateTipo($idtipo);

    header('Location: /tipos');
    exit;
});