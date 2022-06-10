<?php
require_once('pmb_cabecalho.php');


switch ($_GET['erro']) {
    case 1: //salva com sucesso
        echo '<script language="Javascript">
            alert("Localidade salva com sucesso!");
          </script>';
        break;
    case 2: //erro ao salvar
        echo '<script language="Javascript">
            alert("Localidade nao pode ser salva!");
          </script>';
        break;
    case 3: //excluida com sucesso
        echo '<script language="Javascript">
            alert("Localidade excluida com sucesso!");
          </script>';
        break;
    case 4: //erro ao excluir
        echo '<script language="Javascript">
            alert("Localidade nao pode ser excluida!");
          </script>';
        break;
}
?>

<script>
    function valida_exc_local() {
        var retorno = confirm('Confirma exclusao da localidade?');

        return (retorno);
    }
</script>

<div class="body">
    <div class="body-title">
        <h2>Localidades</h2>
    </div>
    <div class="body-content">
        <div class="action-bar">
            <!-- form -->
            <div class="form-action">
                <div class="action-bar-label">
                    Selecione para adicionar uma localidade
                </div>
                <button class="action-bar-button" value="Incluir Localidade" onClick="location.href='/pmb_localidade_editar.php'">Adicionar localidade</button>
            </div>
        </div>

        <div class='content-area'>
            <div class="form-body">
                <?php
                $sql = "SELECT  idlocalidade, localidade FROM cms_localidades ORDER BY localidade";

                $sql = $db->query($sql);
    
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Localidade</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($linha = $db->fetchArray($sql)) {
                            $idlocaliade = $linha['idlocalidade'];
                            $localidade = $linha['localidade'];
                            echo "
                             <tr>
                             <td style='font-weight: bolder;'>{$idlocaliade}</td>
                             <td>{$localidade}</td>
                             <td>
                                 <div class='actions'>
                                     <a href='pmb_localidade_excluir.php?id=$idlocaliade' class='delete' onClick='return valida_exc_local()'><span class='fas fa-trash-can'></span></a>
                                 </div>
                             </td>
                         </tr>
                             ";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
require_once "pmb_rodape.php";
?>