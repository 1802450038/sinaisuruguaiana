<?php
if (file_exists("init.php")) {
    require_once "init.php";
} else {
    die("Arquivo de init não encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";


$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);

$idmarca = (int)($_GET['id']);

$query = "SELECT 
l.localidade, 
p.nome, 
p.cpf,
p.rg,
ps.nome AS nomesecundario,
pt.nome AS nometerciario,
pq.nome AS nomequaternario,
m.numero,
m.observacao, 
m.caminho, 
m.data_cadastro,
m.data_atualizacao,
m.data_validade

FROM cms_marcas m
LEFT JOIN cms_localidades l ON l.idlocalidade = m.idlocalidade
LEFT JOIN cms_produtores p ON p.idprodutor = m.idprodutor
LEFT JOIN cms_produtores ps ON ps.idprodutor = m.idprodutorsecundario
LEFT JOIN cms_produtores pt ON pt.idprodutor = m.idprodutorterciario
LEFT JOIN cms_produtores pq ON pq.idprodutor = m.idprodutorquaternario
WHERE idmarca = " . $idmarca;

$sql = $db->query($query);
$linha = $db->fetchArray($sql);
$localidade = $linha['localidade'];
$nome = $linha['nome'];
$cpf = $linha['cpf'];
$rg = $linha['rg'];
$produtorsecundario = $linha['nomesecundario'];
$produtorterciario = $linha['nometerciario'];
$produtorquaternario = $linha['nomequaternario'];
$caminho = $linha['caminho'];
$numero = $linha['numero'];
$observacao = $linha['observacao'];
$data_cadastro = $linha['data_cadastro'];
$data_atualizacao = $linha['data_atualizacao'];
$data_validade = $linha['data_validade'];

$mesext['01'] = "janeiro";
$mesext['02'] = "fevereiro";
$mesext['03'] = "mar�o";
$mesext['04'] = "abril";
$mesext['05'] = "maio";
$mesext['06'] = "junho";
$mesext['07'] = "julho";
$mesext['08'] = "agosto";
$mesext['09'] = "setembro";
$mesext['10'] = "outubro";
$mesext['11'] = "novembro";
$mesext['12'] = "dezembro";

$dateNow = date("d") . "/ " .  $mesext[date('m')] . "/ " . date("Y");

// echo $data_validade;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/certificado.css">
    <title>Certificado Marca</title>
</head>

<body>
    <div class="certificado-body">
        <div class="certificado-header">
            <div class="certificado-brasao">
                <img src="./imagens/brasao.jpg" alt="" srcset="">
            </div>
            <div class="certificado-title">
                <h2>PREFEITURA MUNICIPAL DE URUGUAIANA</h2>
                <h2>Secretaria de Desenvolvimento Econômico</h2>
                <h3>Diretoria de Agricultura</h3>
            </div>
            <div class="certificado-ponte">
                <img src="./imagens/logo_ponte.jpg" alt="" srcset="">
            </div>
        </div>
        <div class="certificado-content">
            <div class="certificado-content-left">
                <img src="<?php echo $caminho ?>" alt="" srcset="">
            </div>
            <div class="certificado-content-right">
                <div class="certificado-content-title">
                    <h3>CERTIFICADO DE MARCAS E SINAIS</h3>
                </div>
                <div class="certificado-content-items">
                    <div class="certificado-content-item">
                        <div class="certificado-content-item-title">Registrado Para: </div>
                        <div class="certificado-content-item-value"><?php echo "$nome" ?></div>
                    </div>
                    <div class="certificado-content-item">
                        <div class="certificado-content-item-title">Localidade: </div>
                        <div class="certificado-content-item-value"><?php echo "$localidade" ?></div>
                    </div>
                    <div class="certificado-content-item">
                        <div class="certificado-content-item-title">CPF: </div>
                        <div class="certificado-content-item-value"><?php echo "$cpf" ?></div>
                    </div>
                    <div class="certificado-content-item">
                        <div class="certificado-content-item-title">RG: </div>
                        <div class="certificado-content-item-value"><?php echo "$rg" ?></div>
                    </div>
                    <div class="certificado-content-item">
                        <div class="certificado-content-item-title">Numero do Certificado: </div>
                        <div class="certificado-content-item-value"><?php echo "$rg" ?></div>
                    </div>
                    <div class="certificado-content-item">
                        <div class="certificado-content-item-title">Data de Validade: </div>
                        <div class="certificado-content-item-value">23/06/2022</div>
                    </div>
                    <div class="certificado-content-item">
                        <div class="certificado-content-item-title">Emitido em: </div>
                        <div class="certificado-content-item-value">Uruguaiana, <?php echo "$dateNow";?></div>
                    </div>
                    <div class="certificado-signatures">
                        <div class="certificado-signatures-item">
                            <div class="certificado-signature-line"></div>
                            <div class="certificado-signature-title">Secretario de Desenvolvimento Econômico</div>
                        </div>
                        <div class="certificado-signatures-item">
                            <div class="certificado-signature-line"></div>
                            <div class="certificado-signature-title">Servidor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>