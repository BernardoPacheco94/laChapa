<?php

require_once "vendor/autoload.php";

use LaChapa\DB\Sql;
use LaChapa\Page;

$app = new \Slim\Slim();

$app->get('/', function(){
    $sql = new Sql;
    
    

    $page = new Page();

    $page->setTpl('index');
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