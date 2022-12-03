<?php

use LaChapa\Model\Atendente;
use LaChapa\Model\Ingrediente;
use LaChapa\Page;
use LaChapa\Model\Mesa;
use LaChapa\Model\Produto;
use LaChapa\Model\Tipo;

//Rota para a pagina principal - deck mesas
$app->get('/', function(){    
    $page = new Page();
    

    $page->setTpl('index',[
        'todasMesas' => Mesa::exibeTodas(),
        'mesasExibidas' => Mesa::mesasExibidas(),
        'mesaOculta' => Mesa::mesasOcultas(),
        'atendentes' => Atendente::listaAtendentes(),
        'tipos'=>Tipo::listaTipos(),
        'produtos'=> Produto::listaProdutos()
    ]);
});




//Rota adicionar nova mesa
$app->get('/addMesa', function(){
    $mesa = new Mesa;

    $mesa->novaMesa();

    header('Location: /');
    exit;
});

//Rota reexibir mesa
$app->get('/exibeMesa/:idmesa', function($idmesa){
    $mesa = new Mesa;

    $mesa->exibirMesa($idmesa);

    header('Location: /');
    exit;    
});

//Rota remover mesa
$app->get('/removerMesa/:idmesa', function($idmesa){
    $mesa = new Mesa;

    $mesa->removerMesa($idmesa);

    header('Location: /');
    exit;
});

