<?php
if (file_exists("init.php")) {
    require_once "init.php";
} else {
    die("Arquivo de init não encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);


?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/form.css">
	<link rel="stylesheet" href="css/table.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
	<title>Marcas e sinais</title>
</head>

<body>
    <div class="header">
        <div class="pmu-logo">
            <img class="logo" src="imagens/logo.png" alt="">
            <img class="logo-mobile" src="imagens/brasao.png" alt="">
        </div>
        <div class="sinais-logo">
            <img src="imagens/cabecalho.png" alt="">
        </div>
    </div>

    <div class="content">
        <div class="nav-margin" id="nav-margin"></div>
        <div class="nav" id="nav">
            <div class="nav-title">
                <h3>MENU</h3>
            </div>
            <ul>
                <li>
                    <a href="pmb_cms.php"><span>INÍCIO</span> <i class="nav-ico fas fa-house-user "> </i></a>
                </li>
                <li>
                    <a href="pmb_marca.php"><span>MARCAS</span> <i class="nav-ico fas fas fa-registered"> </i> </a>
                </li>
                <li>
                    <a href="pmb_sinal.php"><span>SINAIS</span> <i class="nav-ico fas fas fa-signature"> </i> </a>
                </li>
                <li>
                    <a href="pmb_produtor.php"><span>PRODUTORES</span> <i class="nav-ico fas fas fa-users-between-lines"> </i> </a>
                </li>
                <li>
                    <a href="pmb_localidade.php"><span>LOCALIDADES</span> <i class="nav-ico fas fas fa-location-dot"> </i></a>
                </li>
                <li>
                    <a href="pmb_senha.php"><span>ALTERAR SENHA</span> <i class="nav-ico fab fa-expeditedssl"></i></a>
                </li>
                <li>
                    <a href="pmb_logoff.php"><span>SAIR</span> <i class="nav-ico fas fa-door-open"> </i> </a>
                </li>
            </ul>
        </div>
        <div class="nav-mobile">
            <ul class="mobile-body">
                <li class="mobile-item">
                    <a href="pmb_cms.php" class="nav-link"> <i class="nav-ico fas fa-house-user "> </i> <span>INÍCIO</span></a>
                </li>
                <li class="mobile-item">
                    <a href="pmb_marca.php" class="nav-link"> <i class="nav-ico fas fas fa-registered"> </i> <span>MARCAS</span></a>
                </li>
                <li class="mobile-item">
                    <a href="pmb_sinal.php" class="nav-link"> <i class="nav-ico fas fas fa-signature"> </i> <span>SINAIS</span></a>
                </li>
                <li class="mobile-item">
                    <a href="pmb_produtor.php" class="nav-link"> <i class="nav-ico fas fas fa-users-between-lines"> </i> <span>PRODUTORES</span></a>
                </li>
                <li class="mobile-item">
                    <a href="pmb_localidade.php" class="nav-link"> <i class="nav-ico fas fas fa-location-dot"> </i> <span>LOCALIDADES</span></a>
                </li>
                <li class="mobile-item">
                    <a href="pmb_senha.php" class="nav-link"> <i class="nav-ico fab fa-expeditedssl"></i> <span>SENHA</span></a>
                </li>
                <li class="mobile-item">
                    <a href="pmb_logoff.php" class="nav-link"> <i class="nav-ico fas fa-door-open"> </i> <span>SAIR</span></a>
                </li>
            </ul>
        </div>
