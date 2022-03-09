<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин:</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Главная</a>
        </div>

        <?php if(isset($_SESSION['guest'])):?>
            <ul class="nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?=$_SESSION['guest'] ? : $_SESSION['guest']['name']?></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/user/logout">Выйти</a></li>
                    </ul>
                </li>
            </ul>
        <?php else:?>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="/user/login">Войти</a></li>
                <li class="nav-item"><a class="nav-link" href="/user/registration">Регистрация</a></li>
            </ul>
        <?php endif?>
    </div>
</nav>
<div class="container">
    <div class="starter-template">
        <?php if(isset($_SESSION['result']['success'])):?>
            <p class="alert alert-success"><?=$_SESSION['result']['success']?></p>
            <?php unset($_SESSION['result']);?>
        <?endif;?>


    </div>
</div>

<?php include 'application/views/'.$content_view; ?>

<footer>
    <div class="container">
        <div class="row">

        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/script.js"></script>

</body>
</html>