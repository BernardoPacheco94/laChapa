<?php

use LaChapa\Model\Tipo;
use LaChapa\Page;

//pagina principal - visualizar produtos
$app->get('/cardapio', function(){
    $page = new Page();

    $page->setTpl('cardapio');
});

$app->get('/addTipo', function(){
        
    $tipo = new Tipo;

    $tipo->setData($_GET);

    $tipo->salvaTipo();

    header('Location: /cardapio');
    exit;
});