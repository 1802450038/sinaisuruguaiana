<?php
require_once('pmb_cabecalho.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select idlocalidade, nome, rg, cpf, ie, endereco, telefone from cms_produtores where idprodutor = " . $id;
    //$result = pg_query($conect, $sql)
    //or die("Nao foi possivel conectar no banco de dados!");

    $sql = $db->query($sql);

    //$linha = pg_fetch_array ( $result );
    $linha = $db->fetchArray($sql);
    $local = $linha['idlocalidade'];
    $nome = $linha['nome'];
    $rg = $linha['rg'];
    $cpf = $linha['cpf'];
    $ie = $linha['ie'];
    $endereco = $linha['endereco'];
    $telefone = $linha['telefone'];
} else {
    $id = "";
    $local = "";
    $nome = "";
    $rg = "";
    $cpf = "";
    $ie = "";
    $endereco = "";
    $telefone = "";
}


?>

<SCRIPT>
    function validadados() {
        if (formulario.idlocalidade.value == "") {
            alert("Informe a localidade!")
            return (false)
        }

        if (formulario.nome.value == "") {
            alert("Informe o nome!")
            return (false)
        }

        if (formulario.cpf.value == "") {
            alert("Informe o CPF!")
            return (false)
        }

        if (formulario.ie.value == "") {
            alert("Informe a Inscricao Estadual!")
            return (false)
        }

        formulario.submit();

    }
</SCRIPT>

<div class="body">
    <div class="body-title">
        <h2>Cadastrar Produtor</h2>
    </div>
    <div class="body-content">
        <div class="search-bar">
            <form action="pmb_produtor_salvar.php"  method="post" name="formulario" onSubmit="return validadados()">
                <div class="form-body">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="localidade">Selecione a Cidade</label>
                            <select name="localidade" id="localidade">
                                <?php

                                $sql = "select idlocalidade, localidade from cms_localidades order by localidade";
                                $sql = $db->query($sql);
                                echo "<option value='' selected>SELECIONE</option>";
                                while ($linha = $db->fetchArray($sql)) {
                                    if (isset($_POST['localidade'])) {
                                        if ($linha['idlocalidade'] == $_POST['localidade'])
                                            echo "<option value=" . $linha['idlocalidade'] . " selected>" . $linha['localidade'] . "</option>";
                                        else
                                            echo "<option value=" . $linha['idlocalidade'] . ">" . $linha['localidade'] . "</option>";
                                    } else if (isset($_GET['id'])) {
                                        if ($linha['idlocalidade'] == $local)
                                            echo "<option value=" . $linha['idlocalidade'] . " selected>" . $linha['localidade'] . "</option>";
                                        else
                                            echo "<option value=" . $linha['idlocalidade'] . ">" . $linha['localidade'] . "</option>";
                                    } else {
                                        echo "<option value=" . $linha['idlocalidade'] . ">" . $linha['localidade'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="nome">Nome Completo</label>
                            <?php
                            if ($nome) {
                                echo ("<input name='nome' id='nome' type='text' class='form-item-input-text' value='$nome'>");
                            } else {
                                echo ("<input name='nome' id='nome' type='text' class='form-item-input-text'>");
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="cpf">CPF</label>
                            <?php
                            if ($cpf) {
                                echo ("<input name='cpf' id='cpf' type='text' class='form-item-input-text' value='$cpf'>");
                            } else {
                                echo ("<input name='cpf' id='cpf' type='text' class='form-item-input-text'>");
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="cpf">RG</label>
                            <?php
                            if ($rg) {
                                echo ("<input name='rg' id='rg' type='text' class='form-item-input-text' value='$rg'>");
                            } else {
                                echo ("<input name='rg' id='rg' type='text' class='form-item-input-text'>");
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="ie">Livro / Pagina</label>
                            <?php
                            if ($ie) {
                                echo ("<input name='ie' id='ie' type='text' class='form-item-input-text' value='$ie'>");
                            } else {
                                echo ("<input name='ie' id='ie' type='text' class='form-item-input-text'>");
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="endereco">Endereço</label>
                            <?php
                            if ($endereco) {
                                echo ("<input name='endereco' id='endereco' type='text' class='form-item-input-text' value='$endereco'>");
                            } else {
                                echo ("<input name='endereco' id='endereco' type='text' class='form-item-input-text'>");
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="telefone">Telefone</label>
                            <?php
                            if ($telefone) {
                                echo ("<input name='telefone' id='telefone' type='text' class='form-item-input-text' value='$telefone'>");
                            } else {
                                echo ("<input name='telefone' id='telefone' type='text' class='form-item-input-text'>");
                            }
                            ?>
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