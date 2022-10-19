<?php

require_once "vendor/autoload.php";

use LaChapa\DB\Sql;
use LaChapa\Page;
use LaChapa\Model\Mesa;

$app = new \Slim\Slim();

$app->config('debug', true);

require_once "functions.php";
require_once "route".DIRECTORY_SEPARATOR."mesas.php";
require_once "route".DIRECTORY_SEPARATOR."cardapio.php";
require_once "route".DIRECTORY_SEPARATOR."tipo.php";
require_once "route".DIRECTORY_SEPARATOR."caixa.php";
require_once "route".DIRECTORY_SEPARATOR."ingredientes.php";
require_once "route".DIRECTORY_SEPARATOR."atendentes.php";
require_once "route".DIRECTORY_SEPARATOR."comandas.php";






$app->run();