<?php

use LaChapa\Model\Atendente;
use LaChapa\Model\Comanda;
use LaChapa\Page;

$app->config('debug',true);

$app->post('/novaComanda', function(){
    $comanda = new Comanda;

    $comanda->setData($_POST);
    
    $comanda->novaComanda();

    header('Location: /index');
    exit;    
});