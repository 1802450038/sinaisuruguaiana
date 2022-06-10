<?php
if(file_exists("init.php")){
        require_once "init.php";
} else {
        die("Arquivo de init n�o encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);

$localidade = $_POST['localidade'];
$nome = $_POST['nome'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$ie = $_POST['ie'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];

if ((!isset($_POST['id'])) || ($_POST['id'] == ''))
{
    $id = null;

    //pg_query($conect, "set datestyle to 'sql, dmy'");
    
    $hoje = date("d/m/Y");
    
    $sql = "insert into cms_produtores (idlocalidade, nome, rg, cpf, ie, endereco, telefone, data_cadastro) 
    values ($localidade, '$nome', '$rg', '$cpf', '$ie', '$endereco', '$telefone', NOW())";

    if ($sql = $db->query($sql))
	header("Location: pmb_produtor.php?erro=1");
    else
	header("Location: pmb_produtor.php?erro=2");
}
else
{
    $id = $_POST['id'];
    $sql = "update cms_produtores set idlocalidade = '$localidade', nome = '$nome', rg = '$rg', cpf = '$cpf',
    ie = '$ie', endereco = '$endereco', telefone = '$telefone' where idprodutor = $id";
    
    if ($sql = $db->query($sql))
    	header("Location: pmb_produtor.php?erro=1");
    else
        header("Location: pmb_produtor.php?erro=2");
}

ob_flush();

?>