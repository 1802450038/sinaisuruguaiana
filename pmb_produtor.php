<?php
if (file_exists("init.php")) {
    require_once "init.php";
} else {
    die("Arquivo de init não encontrado");
}
require_once('pmb_conecta.php');
require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);

require_once('pmb_cabecalho.php');


switch ($_GET['erro']) {
    case 1: //salva com sucesso
        echo '<script language="Javascript">
            alert("Produtor salvo com sucesso!");
          </script>';
        break;
    case 2: //erro ao salvar
        echo '<script language="Javascript">
            alert("Produtor nao pode ser salvo!");
          </script>';
        break;
    case 3: //excluida com sucesso
        echo '<script language="Javascript">
            alert("Produtor excluido com sucesso!");
          </script>';
        break;
    case 4: //erro ao excluir
        echo '<script language="Javascript">
            alert("Produtor nao pode ser excluido!");
          </script>';
        break;
}
?>

<script>
    function valida_exc() {
        var retorno = confirm('Confirma exclusao do produtor?');

        return (retorno);
    }
</script>

<div class="body">
    <div class="body-title">
        <h2>Produtores</h2>
    </div>
    <div class="body-content">
        <div class="action-bar">
            <!-- form -->
            <div class="form-action">
                <div class="action-bar-label">
                    Selecione para adicionar um produtor
                </div>
                <button class="action-bar-button" value="Incluir Produtor" onClick="location.href='/pmb_produtor_editar.php'">Adicionar produtor</button>
            </div>
        </div>
        <div class="search-bar">
            <form method="post" action="pmb_produtor.php" name="formulario">
                <div class="form-body">
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="observacao">Nome</label>
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
                            <label class="form-item-input-label" for="produtor">Selecione a quantidade</label>
                            <select name="quantity" id="quantity">
                                <?php
                                if (isset($_POST['quantity'])) {
                                    echo "<option value=" . $_POST['quantity'] . " selected>" . $_POST['quantity'] . "</option>";
                                } else if (isset($_GET['quantity'])) {
                                    echo "<option value=" . $_GET['quantity'] . " selected>" . $_GET['quantity'] . "</option>";
                                }
                                echo "
                                                <option value='50'>50</option>
                                                <option value='100'>100</option>
                                                <option value='200'>200</option>
                                                <option value='500'>500</option>
                                                <option value='1000'>1000</option>
                                            ";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input-action">
                            <input class="clear-btn" type="reset" value="Limpar">
                            <input class="save-btn" type="submit" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class='content-area'>
            <div class="form-body">
                <?php
                $page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);

                $itemsPerPage =  21;

                if (isset($_POST['quantity'])) {
                    $itemsPerPage = (int)$_POST['quantity'];
                } else if (isset($_GET['quantity'])) {
                    $itemsPerPage = (int)$_GET['quantity'];
                }



                $search = "nome";
                $term = "";



                if ($_POST['produtor']) {
                    $search = "-idprodutor";
                    $term =  (int)$_POST['produtor'];
                }



                $start = ($page - 1) * $itemsPerPage;


                $query = "SELECT SQL_CALC_FOUND_ROWS idprodutor, nome
                        FROM cms_produtores
                        WHERE $search LIKE '%$term%' ORDER BY nome LIMIT $start, $itemsPerPage";

                $rows = "SELECT FOUND_ROWS() AS nrtotal;";

                $query = $db->query($query);
                $rows = $db->query($rows);

                $rows = $db->fetchArray($rows);

                $total = (int)$rows[0];

                $pages = ceil($total / $itemsPerPage);


                $links = array();

                for ($i = 1; $i <= $pages; $i++) {
                    array_push($links, [
                        'link' => '/pmb_produtor.php?' . http_build_query([
                            'page' => $i,
                            'quantity' => $itemsPerPage,
                            'search' => $search,
                            'term' => $term

                        ]),
                        'text' => $i
                    ]);
                }
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome completo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($linha = $db->fetchArray($query)) {
                            $idprodutor = $linha['idprodutor'];
                            $nome = $linha['nome'];
                            echo "
                             <tr>
                             <td style='font-weight: bolder;'>{$idprodutor}</td>
                             <td>{$nome}</td>
                             <td>
                                 <div class='actions'>
                                     <a href='#' class='edit'><span class='fas fa-pen-to-square'></span></a>
                                     <a href='#' class='view'><span class='fas fa-eye'></span></a>
                                     <a href='#' class='delete'><span class='fas fa-trash-can'></span></a>
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
        <div class="paginator ">
            <div class="paginator-row ">
                <?php
                for ($j = $page - 2; $j < ($page + 5); $j++) {
                    if ($links[$j]['text'] > 0) {
                        echo "
                                    <a href='{$links[$j]['link']}' class='paginatior-item '>{$links[$j]['text']}</a>
                                    ";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
require_once "pmb_rodape.php";
?>