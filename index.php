<?php

require_once "vendor/autoload.php";

use LaChapa\DB\Sql;

$app = new \Slim\Slim();

$app->get('/', function(){
    $sql = new Sql;

	echo 'começou!!!!';
});

$app->run();