<?php
if (isset($_GET['erro'])) {
    switch ($_GET['erro']) {
        case 1: //salva com sucesso
            echo '<script language="Javascript">
            alert("Marca salva com sucesso!");
          </script>';
            break;
        case 2: //erro ao salvar
            echo '<script language="Javascript">
            alert("Marca nao pode ser salva!");
          </script>';
            break;
        case 3: //excluida com sucesso
            echo '<script language="Javascript">
            alert("Marca excluida com sucesso!");
          </script>';
            break;
        case 4: //erro ao excluir
            echo '<script language="Javascript">
            alert("Marca nao pode ser excluida!");
          </script>';
            break;
        case 5: //imagem duplicada
            echo '<script language="Javascript">
            alert("Ja existe uma marca com este nome de arquivo!");
          </script>';
            break;
        case 6: //formato invalido
            echo '<script language="Javascript">
            alert("Formato de arquivo invalido!");
          </script>';
            break;
        case 7: //formato invalido
            echo '<script language="Javascript">
            alert("Imagem excedeu o tamanho maximo! (1MB)");
          </script>';
            break;
    }
}
require_once('pmb_cabecalho.php');
?>
<div class="body">
    <div class="body-title">
        <h2>Sinais</h2>
    </div>
    <div class="body-content">
        <div class="action-bar">
            <!-- form -->
            <div class="form-action">
                <div class="action-bar-label">
                    Selecione para adicionar um sinal
                </div>
                <button class="action-bar-button" value="Incluir Marca" onClick="location.href='/marca_editar.php'">Adicionar sinal</button>
            </div>
        </div>
        <div class="search-bar">
            <form method="post" action="pmb_marca.php" name="formulario">
                <div class="form-body">
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="localidade">Selecione a Localidade</label>
                            <select name="localidade" id="localidade">
                                <?php
                                // require_once('pmb_conecta.php');
                                $sql = "select idlocalidade, localidade from cms_localidades order by localidade";
                                $sql = $db->query($sql);
                                echo "<option value='' selected>Todas</option>";
                                while ($linha = $db->fetchArray($sql)) {

                                    if (isset($_POST['localidade'])) {
                                        if ($linha['idlocalidade'] == $_POST['localidade']) {
                                            echo "<option value=" . $linha['idlocalidade'] . " selected>" . $linha['localidade'] . "</option>";
                                        } else {
                                            echo "<option value=" . $linha['idlocalidade'] . ">" . $linha['localidade'] . "</option>";
                                        }
                                    } else if (isset($_GET['localidade'])) {
                                        if ($linha['idlocalidade'] == $_GET['localidade']) {
                                            echo "<option value=" . $linha['idlocalidade'] . " selected>" . $linha['localidade'] . "</option>";
                                        }
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
                            <label class="form-item-input-label" for="produtor">Selecione o Produtor</label>
                            <select name="produtor" id="produtor">
                                <?php
                                // require_once('pmb_conecta.php');
                                $sql = "select idprodutor, nome from cms_produtores order by nome";
                                $sql = $db->query($sql);
                                echo "<option value='' selected>Todos</option>";
                                while ($linha = $db->fetchArray($sql)) {
                                    if (isset($_POST['produtor']))
                                        if ($linha['idprodutor'] == $_POST['produtor'])
                                            echo "<option value=" . $linha['idprodutor'] . " selected>" . $linha['nome'] . "</option>";
                                        else
                                            echo "<option value=" . $linha['idprodutor'] . ">" . $linha['nome'] . "</option>";
                                    else
                                        echo "<option value=" . $linha['idprodutor'] . ">" . $linha['nome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input">
                            <label class="form-item-input-label" for="produtor">Selecione a quantidade</label>
                            <select name="quantity" id="quantity">

                                <?php
                                // echo "<option value='10' selected>10</option>";

                                if (isset($_POST['quantity'])) {
                                    echo "<option value=" . $_POST['quantity'] . " selected>" . $_POST['quantity'] . "</option>";
                                } else if (isset($_GET['quantity'])) {
                                    echo "<option value=" . $_GET['quantity'] . " selected>" . $_GET['quantity'] . "</option>";
                                }
                                echo "
                                                <option value='9'>9</option>
                                                <option value='21'>21</option>
                                                <option value='51'>51</option>
                                                <option value='102'>102</option>
                                            ";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input-group">
                            <div class="checkgroup">
                                <label for="numero">Numero</label>
                                <input name="ch_numero" type="checkbox" class="checkmark" <?php
                                                                                            if (isset($_POST['ch_numero'])) {
                                                                                                if ($_POST['ch_numero'] == "on")
                                                                                                    echo "checked";
                                                                                                else
                                                                                                    echo "";
                                                                                            } else
                                                                                                echo "";
                                                                                            ?>>
                            </div>

                            <div class="checkgroup">
                                <label for="letra">Letra</label>
                                <input name="ch_letra" type="checkbox" class="checkmark" <?php
                                                                                            if (isset($_POST['ch_letra'])) {
                                                                                                if ($_POST['ch_letra'] == "on")
                                                                                                    echo "checked";
                                                                                                else
                                                                                                    echo "";
                                                                                            } else
                                                                                                echo "";
                                                                                            ?>>
                            </div>

                            <div class="checkgroup">
                                <label for="figura">Figura</label>
                                <input name="figura" id="figura" type="checkbox" class="checkmark" <?php
                                                                                                    if (isset($_POST['ch_figura'])) {
                                                                                                        if ($_POST['ch_figura'] == "on")
                                                                                                            echo "checked";
                                                                                                        else
                                                                                                            echo "";
                                                                                                    } else
                                                                                                        echo "";
                                                                                                    ?>>
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="form-item-input">
                            <input class="search-btn" type="submit" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class='content-area'>
            <div class='card-row'>
                <?php
                require_once('pmb_conecta.php');


                $page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);

                $itemsPerPage =  21;

                if (isset($_POST['quantity'])) {
                    $itemsPerPage = (int)$_POST['quantity'];
                } else if (isset($_GET['quantity'])) {
                    $itemsPerPage = (int)$_GET['quantity'];
                }



                $search = "m.idmarca";
                $term = "";




                if ($_POST['localidade']) {
                    $search = "l.idlocalidade";
                    $term =  (int)$_POST['localidade'];
                }

                if ($_POST['produtor']) {
                    $search = "m.idprodutor";
                    $term =  (int)$_POST['produtor'];
                }



                $start = ($page - 1) * $itemsPerPage;


                $query = "SELECT SQL_CALC_FOUND_ROWS m.idmarca, m.observacao, l.localidade, p.nome, m.numero, m.caminho 
                        FROM cms_marcas m
                        LEFT JOIN cms_localidades l ON l.idlocalidade = m.idlocalidade
                        LEFT JOIN cms_produtores p ON p.idprodutor = m.idprodutor
                        WHERE $search LIKE '%$term%' ORDER BY p.nome, m.numero LIMIT $start, $itemsPerPage";

                $rows = "SELECT FOUND_ROWS() AS nrtotal;";

                $query = $db->query($query);
                $rows = $db->query($rows);

                $rows = $db->fetchArray($rows);

                $total = (int)$rows[0];

                $pages = ceil($total / $itemsPerPage);


                $links = array();

                for ($i = 1; $i <= $pages; $i++) {
                    array_push($links, [
                        'link' => '/pmb_marca.php?' . http_build_query([
                            'page' => $i,
                            'quantity' => $itemsPerPage,
                            'search' => $search,
                            'term' => $term

                        ]),
                        'text' => $i
                    ]);
                }

                while ($linha = $db->fetchArray($query)) {

                    $idmarca = $linha['idmarca'];
                    $localidade = $linha['localidade'];
                    $produtor = $linha['nome'];
                    $numero = $linha['numero'];
                    $observacao = $linha['observacao'];
                    $caminho = $linha['caminho'];

                    echo "<div class='card'>
                                    <div class='card-img'>
                                        <a href= 'pmb_cms_marca_detalhe.php?idmarca=$idmarca'>
                                            <img src='{$caminho}' alt='' srcset=''>
                                        </a>
                                    </div>
                                    <div class='card-bottom'>
                                        <div class='card-title'>
                                            <div class='title-type'>Sinal</div>
                                            <div class='title-number'>
                                                {$idmarca}
                                            </div>
                                        </div>
                                        <div class='card-items'>
                                            <div class='item'>
                                                <div class='item-name'>Produtor</div>
                                                <div class='item-value prod'>{$produtor}</div>
                                            </div>

                                            <div class='item'>
                                                <div class='item-name'>Localidade</div>
                                                <div class='item-value'>{$localidade}</div>
                                            </div>

                                            <div class='item'>
                                                <div class='item-name'>Observação</div>
                                                <div class='item-value'>{$observacao}</div>
                                            </div>
                                        </div>
                                        <div class='card-actions'>
                                            <div class='action' style='border-right: 1px solid  rgb(130, 196, 130);'><a href='pmb_marca_editar.php?id={$idmarca}' title='Editar'><i class='fas fa-pen-to-square'></i></a></div>
                                            <div class='action' style='border-right: 1px solid  rgb(130, 196, 130);'><a href='pmb_cms_marca_excluir.php?id={$idmarca}' title='Excluir' onClick='return valida_exc()'><i class='fas fa-trash-can '></i></a></div>
                                            <div class='action '><a href='pmb_cms_certificado.php?t=m&id={$idmarca}' title='Certificado'><i class='fas fa-eye '></i></a></div>
                                        </div>
                                    </div>
                                </div>";
                }

                ?>
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
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js " integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin=" anonymous " referrerpolicy="no-referrer "></script>
<script>
    function valida_exc() {
        var retorno = confirm('Confirma exclusao da localidade?');

        return (retorno);
    }
</script>