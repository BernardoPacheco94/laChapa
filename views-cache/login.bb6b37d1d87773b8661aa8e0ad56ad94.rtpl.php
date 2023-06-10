<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Personalizado -->
    <!-- <link rel="stylesheet" href="../style/style.css"> -->

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4c5a422e1b.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff"> -->

    <title>Login</title>
</head>


<body class="bg-gradiente container text-center">
    <?php if( $error ){ ?>
    <div>
        <p>
            <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </p>
        <p>
            <?php echo htmlspecialchars( $errorRegister, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </p>
    </div>
    <?php } ?>
    <form class="form container-fluid col-xs-12 xol-sm-12 col-md-10 col-lg-8 col-xl-8 col-xxl-6 p-3 login-config"
        action="/login" method="POST">
        <i class="fa-solid fa-user fa-4x text-white mb-3"></i>
        <br>
        <input class="col-xs-9 col-sm-8 col-md-6 col-lg-6 col-xl-5 col-xxl-4 m-1" type="text" name="nome"
            id="nome" placeholder="Nome" required>
        <br>
        <input class="col-xs-9 col-sm-8 col-md-6 col-lg-6 col-xl-5 col-xxl-4 m-1" type="password" name="passhash"
            id="passhash" placeholder="Senha" required>
        <br>
        <input class="btn-personalizado" type="submit" value="Entrar" name="btn_entrar">
        <a href="/newuser"><input class="btn-personalizado" type="button" name="novo_usuario" id="novo_usuario"
                value="Novo usuario"></a>
    </form>



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