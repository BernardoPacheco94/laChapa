<?php

use LaChapa\Model\Atendente;
use LaChapa\Model\Comanda;
use LaChapa\Page;

$app->config('debug',true);

$app->get('/novaComanda', function(){
    
    var_dump($_GET);
    exit;
    
});

$app->post('/novaComanda', function(){
    echo 'carregou';
    var_dump($_POST);
    exit;
    
});