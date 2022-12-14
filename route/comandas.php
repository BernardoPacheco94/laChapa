<?php

use LaChapa\Model\Atendente;
use LaChapa\Model\Comanda;
use LaChapa\Model\Produto;
use LaChapa\Model\Ingrediente;
use LaChapa\Page;

$app->config('debug', true);


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

        if (isset($_POST['produtos'][$i]['porcaoextra'])){
            for ($c=0; $c < count($_POST['produtos'][$i]['porcaoextra'])  ; $c++) { 
                $comanda->salvaComandaProdutoPorcaoExtra($_POST['produtos'][$i]['porcaoextra'][$c]['idproduto'], $_POST['produtos'][$i]['porcaoextra'][$c]['qtdporcaoextra'], $_POST['produtos'][$i]['porcaoextra'][$c]['idingrediente']);
            }
        }
        if (isset($_POST['produtos'][$i]['ingredienteadicional'])){
            for ($c=0; $c < count($_POST['produtos'][$i]['ingredienteadicional'])  ; $c++) { 
                $comanda->salvaComandaIngredienteAdicional($_POST['produtos'][$i]['ingredienteadicional'][$c]['idproduto'], $_POST['produtos'][$i]['ingredienteadicional'][$c]['qtdingredienteadicional'], $_POST['produtos'][$i]['porcaoextra'][$c]['idingrediente']);
            }
        }
        if (isset($_POST['produtos'][$i]['removeringrediente'])){
            for ($c=0; $c < count($_POST['produtos'][$i]['removeringrediente'])  ; $c++) { 
                $comanda->salvaComandaProdutoRemoverIngrediente($_POST['produtos'][$i]['removeringrediente'][$c]['idproduto'], $_POST['produtos'][$i]['porcaoextra'][$c]['idingrediente']);
            }
        }
    }
    echo json_encode($_POST);
});
