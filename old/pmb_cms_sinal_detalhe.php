<?php
if (file_exists("init.php")) {
    require_once "init.php";
} else {
    die("Arquivo de init n�o encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);

require_once('pmb_cabecalho.php');

$idsinal = $_GET['idsinal'];

?>

<table border=0 width=650>
    <tr>
        <td colspan='6' align='center' class='td-titulo1'>Sinal</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <?php

    $sql = "select l.localidade, p.nome, s.numero, s.observacao, s.caminho, s.data_cadastro
	from cms_sinais s
	left join cms_localidades l on l.idlocalidade = s.idlocalidade
	left join cms_produtores p on p.idprodutor = s.idprodutor
	where idsinal = " . $idsinal;


    // pg_query($conect, "set datestyle to 'sql, dmy'");
    $sql = $db->query($sql);
    

    // $result = pg_query($conect, $sql)
    // or die("Nao foi possivel conectar no banco de dados!");
    


    // var_dump($sql);

    // $linha = pg_fetch_array ( $result );
    
    $linha = $db->fetchArray($sql);
    $localidade = $linha['localidade'];
    $produtor = $linha['nome'];
    $numero = $linha['numero'];
    $caminho = $linha['caminho'];
    $data_cadastro = $linha['data_cadastro'];
    $observacao = $linha['observacao'];
    $tamanho = getimagesize($caminho);

    if ($tamanho[0] > 630)
        $largura = 630;
    else
        $largura = $tamanho[0];

    echo "
            <tr>
                <td align='center'><img src='" . $caminho . "' width='" . $largura . "'></td></tr>
            <tr>
                <td>N&uacute;mero: " . $numero . "</td></tr>
            <tr>
                <td>Produtor: " . $produtor . "</td></tr>
            <tr>
                <td>Localidade: " . $localidade . "</td></tr>
            <tr>
            <tr>
                <td>Observacao: " . $observacao . "</td></tr>
            <tr>
                <td>Data cadastro: " . date("d/m/Y", strtotime($data_cadastro)) . "</td></tr>
	    <tr><td><br></td></tr>";

    ?>
    <tr>
        <td align="center">
            <input type="reset" value="Voltar" onClick="location.href='pmb_cms_sinal.php'">
        </td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
</table>

<?php
require_once('pmb_rodape.php');
?>