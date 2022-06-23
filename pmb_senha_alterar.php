<?php
if(file_exists("init.php")){
        require_once "init.php";
} else {
        die("Arquivo de init n�o encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);

if (!isset($_SESSION['login']))
    header("Location: index.php?erro=1");

$login = $_SESSION['login'];
$senha = $_POST['senhaatual'];
$novasenha = $_POST['novasenha'];



if(!is_numeric($novasenha)){
        header("Location: pmb_senha.php?erro=5");
		exit;
}

$sql = "select login from cms_usuarios where login = '$login' and senha = md5('$senha') limit 1";

$sql = $db->query($sql);

$linha = $db->fetchArray($sql);

if ($linha){

    $sql = "update cms_usuarios set senha = md5('$novasenha') where login = '$login'";

    if ($sql = $db->query($sql))
	header("Location: pmb_senha.php?erro=1");
    else
	header("Location: pmb_senha.php?erro=6");
}
else
    header("Location: pmb_senha.php?erro=6");


?>
