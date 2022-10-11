<?php

require_once "vendor/autoload.php";

use LaChapa\DB\Sql;
use LaChapa\Page;
use LaChapa\Model\Mesa;

$app = new \Slim\Slim();

$app->config('debug', true);

require_once "route".DIRECTORY_SEPARATOR."mesas.php";
require_once "route".DIRECTORY_SEPARATOR."cardapio.php";




$app->get('/caixa', function(){
    $page = new Page();

    $page->setTpl('caixa');
});

$app->run();