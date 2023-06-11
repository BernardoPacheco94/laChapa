<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="../style/style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4c5a422e1b.js" crossorigin="anonymous"></script>

    <!-- Validação de senha -->
    <script>
        //valida se as senhas estão iguais
        function passValidation() {

            var input_pass = document.getElementById('passhash')
            var input_confirm_pass = document.getElementById('confirma_passhash')

            if (input_pass.value !== input_confirm_pass.value) {
                alert('As senhas não conferem')
                input_pass.value = ''
                input_confirm_pass.value = ''
            }
        }
    </script>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="/res/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/res/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/res/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/res/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/res/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Novo Usuário</title>
</head>

<body class="min-vh-100 vh-100 bg-black container-fluid text-center row align-items-center">
    <div>
        <header>
            <div class="bg-black d-none d-xs-none d-sm-none d-md-block d-lg-block d-xl-block">
                <img src="/res/img/logo.png" alt="logo-la-chapa" class="mx-auto d-block">
            </div>
        </header>
        <form class="form container-fluid col-xs-12 xol-sm-12 col-md-10 col-lg-8 col-xl-8 col-xxl-6 p-3 login-config"
            action="/newuser" method="POST">
            <i class="fa-solid fa-user-plus fa-4x text-white mb-3"></i>
            <br>
            <input class="col-xs-9 col-sm-8 col-md-6 col-lg-6 col-xl-5 col-xxl-4 m-1" type="text" name="nome" id="nome"
                placeholder="Login" required>
            <br>

            <input class="col-xs-9 col-sm-8 col-md-6 col-lg-6 col-xl-5 col-xxl-4 m-1" type="email" name="email"
                id="email" placeholder="Email" required>
            <br>
            <input class="col-xs-9 col-sm-8 col-md-6 col-lg-6 col-xl-5 col-xxl-4 m-1" type="password" name="passhash"
                id="passhash" placeholder="Senha" required>
            <br>
            <input class="col-xs-9 col-sm-8 col-md-6 col-lg-6 col-xl-5 col-xxl-4 m-1" type="password"
                name="confirma_passhash" id="confirma_passhash" placeholder="Confirme a Senha" required>
            <br>
            <input class="btn-dark" type="submit" value="Cadastrar" name="btn_cadastrar" onclick="passValidation()">
            <br>
        </form>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
        crossorigin="anonymous"></script>

    <!-- Script jQuery -->
    <!-- <script src="/res/script/jQuery/jquery-3.6.1.min.js"></script> -->
    <script src="/res/script/jQuery/jquery-develop.js"></script>

    <!-- Script personalizado -->
    <!-- <script src="../js/scripts.js"></script> -->
</body>

</html>