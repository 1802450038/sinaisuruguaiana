<?php
if(file_exists("init.php")){
        require_once "init.php";
} else {
        die("Arquivo de init n�o encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);

require_once ('pmb_cabecalho.php');


switch ($_GET['erro']) {
    case 1: //salva com sucesso
        echo '<script language="Javascript">
            alert("Senha alterada com sucesso!");
          </script>';
        break;
    case 2: //erro ao salvar
        echo '<script language="Javascript">
            alert("Produtor nao pode ser salvo!");
          </script>';
        break;
    case 3: //excluida com sucesso
        echo '<script language="Javascript">
            alert("Produto excluido com sucesso!");
          </script>';
        break;
    case 4: //erro ao excluir
        echo '<script language="Javascript">
            alert("Produtor nao pode ser excluido!");
          </script>';
        break;
}
?>
<div class="body">


<div class="body-content">
            <div class="search-bar">
                <div class="content-home">
                    <div class="title">
                        <h2>Pagina marcas e sinais</h2>
                    </div>
                    <div class="message">
                        <p>Seja bem vindo a pagina de marcas e sinais da cidade de uruguaiana !</p>
                        <p>Aqui é possivel consultar, editar, excluir, realizar o cadastro de 
                            MARCAS e SINAIS e consultar a validade dos certificados basta selecionar a opção desejada no MENU</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
<?php
    require_once ('pmb_rodape.php');
?>