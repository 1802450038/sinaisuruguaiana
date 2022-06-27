<?php

if (file_exists("init.php")) {
    require_once "init.php";
} else {
    die("Arquivo de init não encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

require_once __DIR__ . '/vendor/autoload.php';



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


echo "

<style>

body {
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, Helvetica, sans-serif;
    padding: 40px;
    margin: 0;
    width: 1200px;
    height: 800px;
}

.certificado-body {
    width: 100%;
    height: 100%;
    border: 1px solid rgb(143, 143, 143);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin: 0;
    padding: 0;
}

.certificado-header {
    display: flex;
    height: 200px;
    overflow: hidden;
    width: 100%;
    justify-content: space-between;
    border-bottom: 1px solid rgb(143, 143, 143);
}

.certificado-header div {
    width: 30%;
}

.certificado-header .certificado-brasao,
.certificado-header .certificado-ponte {
    display: flex;
    justify-content: center;
    align-items: center;
}

.certificado-header .certificado-brasao img,
.certificado-header .certificado-ponte img {
    height: 120px;
}


.certificado-header .certificado-title {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

}

.certificado-header .certificado-title h2{
    text-align: center;
    line-height: 20px;
    font-size: 16pt;
    
}

.certificado-header .certificado-title h3{
    text-align: center;
    line-height: 20px;
    font-size: 14pt;
    
}

.certificado-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-direction: row;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;

}

.certificado-content .certificado-content-left {
    height: 100%;
    width: 30%;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.certificado-content .certificado-content-left img {
    margin-top: 30px;
    height: 180px;
}

.certificado-content .certificado-content-right {
    display: flex;
    flex-direction: column;
    width: 90%;
    height: 100%;
    padding-left: 30px;
    border-left: 1px solid rgb(143, 143, 143);
}

.certificado-content .certificado-content-right .certificado-content-title {
    font-size: 16pt;
    margin: 0;
    padding: 0;
    margin-top: 30px;

}
.certificado-content .certificado-content-right .certificado-content-title h3{
    margin: 0;
    margin-bottom: 20px;
}

.certificado-content .certificado-content-right .certificado-content-items {
    flex-wrap: nowrap;
    display: flex;
    flex-direction: column;
    row-gap: 20px;
}

.certificado-content .certificado-content-right .certificado-content-items .certificado-content-item {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: left;
    align-items: left;
}

.certificado-content .certificado-content-right .certificado-content-items .certificado-content-item .certificado-content-item-title {
    font-size: 14pt;
    font-weight: bold;
}

.certificado-content .certificado-content-right .certificado-content-items .certificado-content-item .certificado-content-item-value {
    font-size: 14pt;
    padding-left: 10px;
}

.certificado-content .certificado-content-right .certificado-content-items .certificado-signatures {
    margin-top: 80px;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    flex-wrap: nowrap;
}

.certificado-content .certificado-content-right .certificado-content-items .certificado-signatures .certificado-signatures-item {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    row-gap: 5px;
    text-transform: uppercase;
}

.certificado-content .certificado-content-right .certificado-content-items .certificado-signatures .certificado-signatures-item .certificado-signature-line {
    border-bottom: 2px solid rgb(143, 143, 143);
    height: 1px;
    width: 300px;
}

.certificado-content .certificado-content-right .certificado-content-items .certificado-signatures .certificado-signatures-item .certificado-signature-title {
    font-size: 10pt;
    font-weight: bold;
}


.save-to-pdf {
    border: 1px solid rgb(103, 179, 103);
    height: 70px;
    width: 70px;
    border-radius: 50px;
    background-color: rgb(103, 179, 103);
    color: white;
    display: flex;
    flex-direction: column;
    row-gap: 5px;
    justify-content: center;
    align-items: center;
    font-size: 20pt;
    box-shadow: 0px 0px 20px 5px rgb(191, 235, 179);
    transition: all .3s ease-in-out;
    position: fixed;
    top: 80%;
    left: 90px;
}

.back-page {
    border: 1px solid rgb(103, 127, 179);
    height: 70px;
    width: 70px;
    border-radius: 50px;
    background-color: rgb(103, 127, 179);
    color: white;
    display: flex;
    flex-direction: column;
    row-gap: 5px;
    justify-content: center;
    align-items: center;
    font-size: 20pt;
    box-shadow: 0px 0px 20px 5px rgb(179, 191, 235);
    transition: all .3s ease-in-out;
    position: fixed;
    top: 70%;
    left: 90px;
}

button.save-to-pdf span, .back-page span {
    font-size: 6pt;
    text-transform: uppercase;
}

.save-to-pdf:hover, .back-page:hover {
    color: rgb(104, 105, 104);
    background-color: white;
    border: 1px solid rgb(104, 105, 104) !important;
    box-shadow: none;
}

</style>

<body>
    <div class='certificado-body'>
        <div class='certificado-header'>
            <div class='certificado-brasao'>
                <img src='./imagens/brasao.jpg' alt='' srcset=''>
            </div>
            <div class='certificado-title'>
                <h2>PREFEITURA MUNICIPAL DE URUGUAIANA</h2>
                <h2>Secretaria de Desenvolvimento Econômico</h2>
                <h3>Diretoria de Agricultura</h3>
            </div>
            <div class='certificado-ponte'>
                <img src='./imagens/logo_ponte.jpg' alt='' srcset=''>
            </div>
        </div>
        <div class='certificado-content'>
            <div class='certificado-content-left'>
                <img src='$caminho' alt='' srcset=''>
            </div>
            <div class='certificado-content-right'>
                <div class='certificado-content-title'>
                    <h3>CERTIFICADO DE MARCAS E SINAIS</h3>
                </div>
                <div class='certificado-content-items'>
                    <div class='certificado-content-item'>
                        <div class='certificado-content-item-title'>Registrado Para: </div>
                        <div class='certificado-content-item-value'>'$nome'</div>
                    </div>
                    <div class='certificado-content-item'>
                        <div class='certificado-content-item-title'>Localidade: </div>
                        <div class='certificado-content-item-value'>'$localidade'</div>
                    </div>
                    <div class='certificado-content-item'>
                        <div class='certificado-content-item-title'>CPF: </div>
                        <div class='certificado-content-item-value'>'$cpf'</div>
                    </div>
                    <div class='certificado-content-item'>
                        <div class='certificado-content-item-title'>RG: </div>
                        <div class='certificado-content-item-value'>'$rg'</div>
                    </div>
                    <div class='certificado-content-item'>
                        <div class='certificado-content-item-title'>Numero do Certificado: </div>
                        <div class='certificado-content-item-value'>'$rg'</div>
                    </div>
                    <div class='certificado-content-item'>
                        <div class='certificado-content-item-title'>Data de Validade: </div>
                        <div class='certificado-content-item-value'>23/06/2022</div>
                    </div>
                    <div class='certificado-content-item'>
                        <div class='certificado-content-item-title'>Emitido em: </div>
                        <div class='certificado-content-item-value'>Uruguaiana, '$dateNow';</div>
                    </div>
                    <div class='certificado-signatures'>
                        <div class='certificado-signatures-item'>
                            <div class='certificado-signature-line'></div>
                            <div class='certificado-signature-title'>Secretario de Desenvolvimento Econômico</div>
                        </div>
                        <div class='certificado-signatures-item'>
                            <div class='certificado-signature-line'></div>
                            <div class='certificado-signature-title'>Servidor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body>
";

$mpdf = new \Mpdf\Mpdf([
    'mode' => "UTF-8",
    'format' => 'A4',
    'orientation' => 'L',
    'margin_left' => 0,
    'margin_top' => 0,
    'margin_right' => 0,
    'margin_bottom' => 0,
    'margin_header' => 0,
    'margin_footer' => 0
]);


$stylesheet = file_get_contents('./css/certificado_pdf.css');


var_dump ($html);

// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


// $mpdf->WriteHTML($html);
// $mpdf->Output();
