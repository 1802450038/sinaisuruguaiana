<?php
if (file_exists("init.php")) {
    require_once "init.php";
} else {
    die("Arquivo de init n�o encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);


$localidade = $_POST['localidade'];

$sql = "select count(lower(localidade)) from cms_localidades where localidade like'" . strtolower($localidade) . "'";


$sql = $db->query($sql);
$dados = $db->fetchArray($sql);

$qtd = $dados['count'];

if ($qtd > 0)
    header("Location: pmb_localidade.php?erro=5");

else {
    if ((!isset($_POST['id'])) || ($_POST['id'] == '')) {
        $id = null;

        $sql = "insert into cms_localidades (localidade) values ('$localidade')";

        if ($sql = $db->query($sql)) {
            header("Location: pmb_localidade.php?erro=1");
        } else {
            header("Location: pmb_localidade.php?erro=2");
        }
    }
}

ob_flush();

?>
