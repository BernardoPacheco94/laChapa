<?php

use LaChapa\Model\User;
use LaChapa\Page;

$app->config('debug',true);

$app->get('/login', function(){
        
    $page = new Page([
        'header' => false,
        'footer' => false
    ]);

	$page->setTpl("login", [
		'error' => User::getError(),
		'errorRegister' => User::getErrorRegister(),
		'registerValues' => (isset($_SESSION['registerValues'])) ? $_SESSION['registerValues'] : [
			'nome' => ''
		]
	]);
});

$app->post('/login', function () {

	try {
		$user = User::login($_POST['nome'], $_POST['passhash']);
	} catch (Exception $e) {
		User::setError($e->getMessage());
		header('Location: /login');
		exit;
	}


	header('Location: /');
	exit;
});

$app->get('/newuser', function(){
        
    $page = new Page([
        'header' => false,
        'footer' => false
    ]);

    $page->setTpl('novo-usuario',[

    ]);


    // header('Location: /');
    exit;
});

$app->post('/newuser', function(){
        
    $user = new User;

    $user->novoUsuario($_POST['nome'], $_POST['email'], $_POST['passhash']);

    header('Location: /login');
    exit;
});

$app->get('/logout', function(){
    User::logout();

    header('Location: /login');
    exit;
});

// //Visualizar tipos
// $app->get('/tipos', function(){
//     $listaTipos = (isset($_GET['pesquisar'])) ? Tipo::pesquisar($_GET['pesquisar']) : Tipo::listaTipos();    
    
//     $page = new Page();

//     $page->setTpl('tipos',[
//         'tipos'=> $listaTipos
//     ]);
// });

// // deletar tipo
// $app->get('/tipos/deletar/:idtipo', function($idtipo){
//     $tipo = new Tipo;

//     $tipo->deletarTipo($idtipo);

//     header('Location: /tipos');
//     exit;
// });

// //editar tipo
// $app->get('/editarTipo/:idtipo', function($idtipo){
//     $tipo = new Tipo();

//     $tipo->setData($_GET);

//     $tipo->updateTipo($idtipo);

//     header('Location: /tipos');
//     exit;
// });