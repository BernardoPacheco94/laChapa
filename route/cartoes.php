<?php

use LaChapa\Model\Cartao;
use LaChapa\Model\User;
use LaChapa\Page;

$app->get('/cartoes', function(){
    User::checkLogin();

    $page = new Page();

    $page->setTpl('cartoes',[
        'listacartoes' => Cartao::listaCartoes()
    ]);
});

$app->get('/salvacartoes', function(){
    User::checkLogin();

    $cartoes = new Cartao;

    $cartoes->salvaCartoes(intval($_GET['inicial']), intval($_GET['final']));

    header('Location: /cartoes');
    exit;
});

$app->get('/cartao/deletar/:idcartao', function($idcartao){
    User::checkLogin();
    
    $cartoes = new Cartao;

    $cartoes->deletarCartao($idcartao);

    header('Location: /cartoes');
    exit;
});