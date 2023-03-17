<?php

use LaChapa\Model\Cartao;
use LaChapa\Page;

$app->get('/cartoes', function(){
    $page = new Page();

    $page->setTpl('cartoes',[
        'listacartoes' => Cartao::listaCartoes()
    ]);
});

$app->get('/salvacartoes', function(){
    $cartoes = new Cartao;

    $cartoes->salvaCartoes(intval($_GET['inicial']), intval($_GET['final']));

    header('Location: /cartoes');
    exit;
});

$app->get('/cartao/deletar/:idcartao', function($idcartao){
    $cartoes = new Cartao;

    $cartoes->deletarCartao($idcartao);

    header('Location: /cartoes');
    exit;
});