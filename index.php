<?php

require_once "vendor/autoload.php";

use LaChapa\DB\Sql;
use LaChapa\Page;
use LaChapa\Model\Mesas;

$app = new \Slim\Slim();


//Rota para a pagina principal - deck mesas
$app->get('/', function(){
    
    $page = new Page();

    $page->setTpl('index',[
        'mesa' => Mesas::mesasExibidas(),
        'mesaOculta' => Mesas::mesasOcultas()
    ]);
});

//Rota adicionar nova mesa
$app->get('/addMesa', function(){
    $mesa = new Mesas;

    $mesa->novaMesa();

    header('Location: /');
    exit;
});

//Rota reexibir mesa
$app->get('/exibeMesa/:idmesa', function($idmesa){
    $mesa = new Mesas;

    $mesa->exibirMesa($idmesa);

    header('Location: /');
    exit;    
});

//Rota remover mesa
$app->get('/removerMesa/:idmesa', function($idmesa){
    $mesa = new Mesas;

    $mesa->removerMesa($idmesa);

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