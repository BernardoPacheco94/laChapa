<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        <!-- Biblioteca para trabalhar com formatacao de data no js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4c5a422e1b.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="/res/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/res/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/res/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/res/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/res/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>laChapa</title>
</head>

<body>

    <header>
        <div class="container-fluid bg-black d-none d-xs-none d-sm-none d-md-block d-lg-block d-xl-block">
            <img src="/res/img/logo.png" alt="logo-la-chapa" class="mx-auto d-block">
        </div>
    </header>

    
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-black">
            <div class="container-fluid">
                <a class="navbar-brand d-block d-xl-none d-lg-none d-md-none d-sm-block" href="/">laChapa</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Mesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cardapio">Cardápio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/caixa">Caixa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/atendentes">Atendentes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cartoes">Cadastro de Comandas</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Sair</a>
                        </li>
                    </ul>
                    <!-- <div class="">
                        <ul class="navbar-nav mr-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Sair</a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </nav>



    

