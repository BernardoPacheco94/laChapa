<?php

require_once "vendor/autoload.php";

use LaChapa\DB\Sql;
use LaChapa\Page;
use LaChapa\Model\Mesas;

$app = new \Slim\Slim();


//Rota para a pagina principal - deck mesas
$app->get('/', function(){
    $mesas = Mesas::exibeTodas();
    
    $page = new Page();

    $page->setTpl('index',[
        'mesa' => $mesas
    ]);
});

//Rota adicionar mesa
$app->get('/addMesa', function(){
    $mesa = new Mesas;

    $mesa->novaMesa();

    header('Location: /');
    exit;
});

$app->get('/cardapio', function(){
    $page = new Page();

    $page->setTpl('cardapio');
});

$app->get('/caixa', function(){
    $page = new Page();

    $page->setTpl('caixa');
});

$app->run();