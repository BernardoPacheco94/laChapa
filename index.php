<?php

session_start();
require_once "vendor/autoload.php";


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
require_once "route".DIRECTORY_SEPARATOR."cartoes.php";
require_once "route".DIRECTORY_SEPARATOR."login.php";


$app->run();