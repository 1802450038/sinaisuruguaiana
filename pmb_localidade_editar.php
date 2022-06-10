<?php
require_once('pmb_cabecalho.php');

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);

$id = "";
$localidade = "";
?>

<SCRIPT>
    function validalocalidade() {
        if (formulario.localidade.value == "") {
            alert("Informe a localidade!")
            return (false)
        }
        formulario.submit();

    }
</SCRIPT>


<div class="body">
    <div class="body-title">
        <h2>Cadastrar Localidade</h2>
    </div>
    <div class="body-content">
        <div class="search-bar">
            <form action="pmb_localidade_salvar.php" method="post" name="formulario" onSubmit="return validalocalidade()">
                <div class="form-body">
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="localidade">Localidade</label>
                            <input name='localidade' id='localidade' type='text' class='form-item-input-text'>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input-action">
                            <input class="clear-btn" type="reset" value="Limpar">
                            <input class="save-btn" type="submit" value="Salvar">
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<?php
require_once('pmb_rodape.php');
?>