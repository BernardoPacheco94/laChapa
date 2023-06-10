<?php

use LaChapa\Model;
use LaChapa\Model\Atendente;
use LaChapa\Page;
use LaChapa\Model\User;

$app->config('debug',true);

$app->get('/atendentes', function(){
    User::checkLogin();
    
    $page = new Page();
    
    $page->setTpl('atendentes',[
        'atendentes'=>Atendente::listaAtendentes()
    ]);
});

// Adicionar atendente
$app->get('/addAtendente', function(){
    User::checkLogin();
    $atendente = new Atendente;

    $atendente->setData($_GET);

    $atendente->salvaAtendente();

    header('Location: /atendentes');
    exit;
});

//Rota para deletar atendente
$app->get('/atendente/deletar/:idatendente', function($idatendente){
    User::checkLogin();
    $atendente = new Atendente;

    $atendente->deletarAtendente($idatendente);

    header('Location: /atendentes');
    exit;
});

//editar atendente
$app->get('/editarAtendente/:idatendente', function($idatendente){
    User::checkLogin();
    $atendente = new Atendente;

    $atendente->setData($_GET);

    $atendente->updateAtendente($idatendente);

    header('Location: /atendentes');
    exit;
});

