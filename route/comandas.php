<?php

use LaChapa\Model\Atendente;
use LaChapa\Model\Comanda;
use LaChapa\Model\Produto;
use LaChapa\Model\Ingrediente;
use LaChapa\Page;

$app->config('debug',true);

$app->post('/novaComanda', function(){
    $comanda = new Comanda;

    $comanda->setData($_POST);
    
    $comanda->salvaComanda();

    header('Location: /index.php');
    exit;    
});


$app->get('/comanda/ajax', function(){
    $idproduto = $_GET['idproduto'];

    $produto = new Produto;
    echo ($produto->getAjax($idproduto));
    
});

$app->get('/ingredientes/ajax', function(){
    echo json_encode(Ingrediente::listaIngredientes());
});



$app->post('/salvaprodutoeingredientescomanda/ajax', function(){
    $comanda = new Comanda;
    
    $comanda->setData($_POST);
    // $comanda->salvaComanda();
    // $comanda->salvaComandaMesa();
    // $comanda->salvaComandaProdutos();
    echo json_encode($_POST);
});



