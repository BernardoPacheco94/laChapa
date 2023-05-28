<?php

use LaChapa\Model\Comanda;
use LaChapa\Model\Produto;
use LaChapa\Model\Ingrediente;
use LaChapa\Model\Mesa;
use LaChapa\Page;

$app->config('debug', true);


$app->get('/ingredientesproduto/ajax', function () {
    $idproduto = $_GET['idproduto'];

    $produto = new Produto;
    echo ($produto->getIngredientesProdutoAjax($idproduto));
});

$app->get('/ingredientes/ajax', function () {
    echo json_encode(Ingrediente::listaIngredientes());
});



$app->post('/salvaprodutoeingredientescomanda/ajax', function () {
    $comanda = new Comanda;

    $_POST['idmesa'] = ($_POST['idmesa'] == "" || $_POST['idmesa'] == 0) ? null : $_POST['idmesa'];
    $comanda->setData($_POST);
    $comanda->setidatendente($_POST['idatendente'] == "" || $_POST['idatendente'] == 0 ? null : $_POST['idatendente']);
    try {
        $comanda->salvaComanda();
        $comanda->salvaComandaMesa();
        if (isset($_POST['produtos'])) {
            for ($i = 0; $i < count($_POST['produtos']); $i++) {

                $comanda->salvaComandaProdutos($_POST['produtos'][$i]['idproduto'], $_POST['produtos'][$i]['vlfinalproduto'], $_POST['produtos'][$i]['observacao'], $_POST['produtos'][$i]['nroitem']);


                if (array_key_exists('porcaoextra', $_POST['produtos'][$i])) {
                    for ($c = 0; $c < count($_POST['produtos'][$i]['porcaoextra']); $c++) {
                        $comanda->salvaComandaProdutoPorcaoExtra($_POST['produtos'][$i]['porcaoextra'][$c]['idproduto'], $_POST['produtos'][$i]['porcaoextra'][$c]['qtdporcaoextra'], $_POST['produtos'][$i]['porcaoextra'][$c]['idingrediente'], $_POST['produtos'][$i]['porcaoextra'][$c]['nroitem']);
                    }
                }
                if (array_key_exists('ingredienteadicional', $_POST['produtos'][$i])) {
                    for ($c = 0; $c < count($_POST['produtos'][$i]['ingredienteadicional']); $c++) {
                        $comanda->salvaComandaIngredienteAdicional($_POST['produtos'][$i]['ingredienteadicional'][$c]['idproduto'], $_POST['produtos'][$i]['ingredienteadicional'][$c]['qtdingredienteadicional'], $_POST['produtos'][$i]['ingredienteadicional'][$c]['idingrediente'], $_POST['produtos'][$i]['ingredienteadicional'][$c]['nroitem']);
                    }
                }
                if (array_key_exists('removeringrediente', $_POST['produtos'][$i])) {
                    for ($c = 0; $c < count($_POST['produtos'][$i]['removeringrediente']); $c++) {
                        $comanda->salvaComandaProdutoRemoverIngrediente($_POST['produtos'][$i]['removeringrediente'][$c]['idproduto'], $_POST['produtos'][$i]['removeringrediente'][$c]['idingrediente'], $_POST['produtos'][$i]['removeringrediente'][$c]['nroitem']);
                    }
                }
            }
        }

        echo json_encode($_POST);
    } catch (\Throwable $th) {
        echo json_encode(array(
            "Arquivo" => $th->getFile(),
            "Mensagem" => $th->getMessage(),
            "linha" => $th->getLine()
        ));
    }
});

$app->get('/listagemteste', function () {
    var_dump(Mesa::mesasExibidas());
    exit;
});

$app->get('/listacomandasajax', function () {
    echo json_encode(Comanda::listaComandas());
    exit;
});

$app->post('/removeprodutocomanda', function(){
    $comanda = new Comanda;

    try {
        $comanda->removeComandaProduto($_POST['idcomanda'],$_POST['idcomandaproduto'], $_POST['valortotal']);

        echo json_encode($_POST);
        
    } catch (\Throwable $th) {
        echo json_encode(array(
            "Arquivo" => $th->getFile(),
            "Mensagem" => $th->getMessage(),
            "linha" => $th->getLine()
        ));
    }
});

$app->get('/comanda/print/:idcomanda', function($idcomanda){

    $comanda = new Comanda;
    $page = new Page(
        [
            'header' => false    
        ]);

    $result = $comanda->buscaComanda($idcomanda);

    $page->setTpl('impressao',[
        'dadosComanda' => $result[0]
    ]);
    exit;    
});
$app->get('/comanda/printdev/:idcomanda', function($idcomanda){

    $comanda = new Comanda;
    $result = $comanda->buscaComanda($idcomanda);    
    echo json_encode($result);
    exit;    
});
