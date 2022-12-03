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

// $app->get('/teste/ajax', function(){
//     $var = new Comanda;

//     echo json_encode($var->salvaTeste(3));
//     exit;
// });


$app->post('/salvaprodutoeingredientescomanda/ajax', function(){
    $comanda = new Comanda;
    
    $comanda->setData($_POST);
    $result = $comanda->salvaComanda();
    echo json_encode($comanda->salvaComanda());
});

// $app->get('/salvaprodutoeingredientescomanda/ajax', function(){
//     $comanda = new Comanda;
//     $comanda->setData($_GET);
//     echo json_encode($_GET);
// });

