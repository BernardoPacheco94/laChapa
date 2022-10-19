<?php

use LaChapa\Model\Atendente;
use LaChapa\Page;

$app->config('debug',true);

$app->get('/atendentes', function(){
    // var_dump(Atendente::listaAtendentes())    ;
    // exit;
    $page = new Page();

    $page->setTpl('atendentes',[
        'atendentes'=>Atendente::listaAtendentes()
    ]);
});

// Adicionar atendente
$app->get('/addAtendente', function(){
    $atendente = new Atendente;

    $atendente->setData($_GET);

    $atendente->salvaAtendente();

    header('Location: /atendentes');
    exit;
});

//Rota para deletar atendente
$app->get('/atendente/deletar/:idatendente', function($idatendente){
    $atendente = new Atendente;

    $atendente->deletarAtendente($idatendente);

    header('Location: /atendentes');
    exit;
});

//editar atendente
$app->get('/editarAtendente/:idatendente', function($idatendente){
    $atendente = new Atendente;

    $atendente->setData($_GET);

    $atendente->updateAtendente($idatendente);

    header('Location: /atendentes');
    exit;
});

