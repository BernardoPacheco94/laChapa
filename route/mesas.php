<?php

use LaChapa\Model\Atendente;
use LaChapa\Model\Cartao;
use LaChapa\Model\Comanda;
use LaChapa\Page;
use LaChapa\Model\Mesa;
use LaChapa\Model\Produto;
use LaChapa\Model\Tipo;
use LaChapa\Model\User;

//Rota para a pagina principal - deck mesas
$app->get('/', function(){
    User::checkLogin();

    $page = new Page();


    $page->setTpl('index',[
        'todasMesas' => Mesa::exibeTodas(),
        'mesasExibidas' => Mesa::mesasExibidas(),
        'mesaOculta' => Mesa::mesasOcultas(),
        'atendentes' => Atendente::listaAtendentes(),
        'tipos'=>Tipo::listaTipos(),
        'produtos'=> Produto::listaProdutos(),
        'comandas' => Comanda::listaComandas(),
        'cartoes' => Cartao::listaCartoes()
    ]);

});




//Rota adicionar nova mesa
$app->get('/addMesa', function(){
    User::checkLogin();

    $mesa = new Mesa;

    $mesa->novaMesa();

    header('Location: /');
    exit;
});

//Rota reexibir mesa
$app->get('/exibeMesa/:idmesa', function($idmesa){
    User::checkLogin();

    $mesa = new Mesa;

    $mesa->exibirMesa($idmesa);

    header('Location: /');
    exit;    
});

//Rota remover mesa
$app->get('/removerMesa/:idmesa', function($idmesa){
    User::checkLogin();
    $mesa = new Mesa;

    $mesa->removerMesa($idmesa);

    header('Location: /');
    exit;
});

