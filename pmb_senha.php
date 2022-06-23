<?php
if (file_exists("init.php")) {
    require_once "init.php";
} else {
    die("Arquivo de init não encontrado");
}

require_once('pmb_cabecalho.php');

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);


switch ($_GET['erro']) {
    case 1: //salva com sucesso
        echo '<script language="Javascript">
            alert("Senha alterada com sucesso!");
          </script>';
        break;
    case 5: //erro ao salvar
        echo '<script language="Javascript">
            alert("A senha deve possuir somente numeros!");
          </script>';
		break;
    case 6: //erro ao salvar
        echo '<script language="Javascript">
            alert("Erro ao alterar a senha!");
          </script>';
		break;	
}
?>

<script>
    function validaSenha() {
        if (formulario.novasenha.value != formulario.confirmasenha.value) {
            alert("Confirme a senha!");
            return (false);
        }
        return (true);
    }
</script>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/password.css">
    <title>Alterar Senha</title>
</head>

<body>
    <div class="password-content">
        <div class="login-container" style="margin-top: 10vh;">
            <div class="login-body">
                <div class="login-title">
                    <h2>Alterar Senha</h2>
                    <h5>Marcas & Sinais uruguaina</h5>
                </div>

                <form action="pmb_senha_alterar.php" method="POST" name="formulario" class="login-form" onsubmit="return validaSenha()">
                    <div class="form-item">
                        <label for="senhaatual">Senha Atual</label>
                        <input type="password" name="senhaatual" id="senhaatual">
                    </div>
                    <div class="form-item">
                        <label for="senhaatual">Nova senha</label>
                        <input type="password" name="novasenha" id="novasenha">
                    </div>
                    <div class="form-item">
                        <label for="confirmasenha">Confirme Senha</label>
                        <input type="password" name="confirmasenha" id="confirmasenha">
                    </div>
                    <div class="form-action">
                        <button type="reset" class="reset" onClick="location.href='pmb_cms.php'">Cancelar</button>
                        <button type="submit" class="login" value="salvar">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>