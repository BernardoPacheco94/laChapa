<?php

use LaChapa\Model\Atendente;
use LaChapa\Model\Comanda;
use LaChapa\Model\Produto;
use LaChapa\Model\Ingrediente;
use LaChapa\Page;

$app->config('debug', true);

$app->post('/novaComanda', function () {
    $comanda = new Comanda;

    $comanda->setData($_POST);

    $comanda->salvaComanda();

    header('Location: /index.php');
    exit;
});


$app->get('/comanda/ajax', function () {
    $idproduto = $_GET['idproduto'];

    $produto = new Produto;
    echo ($produto->getAjax($idproduto));
});

$app->get('/ingredientes/ajax', function () {
    echo json_encode(Ingrediente::listaIngredientes());
});



$app->post('/salvaprodutoeingredientescomanda/ajax', function () {
    $comanda = new Comanda;

    $comanda->setData($_POST);
    $comanda->salvaComanda();
    $comanda->salvaComandaMesa();
    for ($i = 0; $i < count($_POST['produtos']); $i++) {
        $comanda->salvaComandaProdutos($_POST['produtos'][$i]['idproduto']);
    }
    
    echo json_encode($_POST);
});

$app->get('/salvaprodutoeingredientescomanda/ajax', function () {
    $comanda = new Comanda;

    $comanda->setData($_GET);
    echo json_encode($_GET);
});

$app->get('/teste', function () {
    $comanda = new Comanda;

    $comanda->setidcomanda('2');

    $produtos = [
        [
            "idproduto" => "34",
            "nomeproduto" => "baguete de frango",
            "vladicional" => "0",
            "vlfinalproduto" => "20"
        ],
        [
            "idproduto" => "26",
            "nomeproduto" => "dog frango",
            "vladicional" => "5",
            "porcaoextra" => [

                "ingredienteporcaoextra" => "hamburguer",
                "idporcaoextra" => "5",
                "qtdporcaoextra" => "2"

            ],
            "vlfinalproduto" => "16"
        ],
        [
            "idproduto" => "15",
            "nomeproduto" => "produto editado",
            "vladicional" => "0",
            "vlfinalproduto" => "50"
        ]
    ];

    

    for ($i = 0; $i < count($produtos); $i++) {
        echo json_encode($comanda->salvaComandaProdutos($produtos[$i]['idproduto']));
    }

});
