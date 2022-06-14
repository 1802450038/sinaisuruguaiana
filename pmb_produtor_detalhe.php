<?php

require_once('pmb_cabecalho.php');

?>

<div class="body">
    <?php
    $id = (int)$_GET['id'];

    $query = "SELECT l.localidade, p.nome, p.rg, p.cpf, p.ie, p.endereco, p.telefone, p.data_cadastro, p.data_atualizacao 
	FROM cms_produtores p
	LEFT JOIN cms_localidades l ON l.idlocalidade = p.idlocalidade
	WHERE idprodutor = $id";
    $sql = $db->query($query);
    $linha = $db->fetchArray($sql);
    $localidade = $linha['localidade'];
    $nome = $linha['nome'];
    $rg = $linha['rg'];
    $cpf = $linha['cpf'];
    $ie = $linha['ie'];
    $endereco = $linha['endereco'];
    $telefone = $linha['telefone'];
    $data_cadastro = $linha['data_cadastro'];
    $data_atualizacao = $linha['data_atualizacao'];

    ?>

    <div class="body-title">
        <h2>Produtor</h2>
    </div>
    <div class="body-content">
        <div class="search-bar">
            <div class="content">
                <div class="profile-content">
                    <div class="profile-top">
                        <div class="profile-name">
                            <h1><?php echo "$nome" ?></h1>
                        </div>
                    </div>
                    <div class="profile-middle">
                        <div class="profile-item-row profile-values">
                            <div class="profile-items-title">
                                <h2>Dados do Produtor</h2>
                            </div>
                            <div class="profile-data">
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Produtor</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$nome" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>RG</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$rg" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>CPF</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$cpf" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Localidade</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$localidade" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Livro / Pagina</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$ie" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Endereço</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$endereco" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Telefone</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$telefone" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Data de cadastro</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$data_cadastro" ?></h4>
                                    </div>
                                </div>
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Atualizado Em</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$data_atualizacao" ?></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                   
                        <div class="profile-item-row profile-markings">
                            <div class="profile-markings-title">
                                <h2>Marcas do produtor</h2>
                            </div>
                            <?php
                            $sql = "SELECT m.idmarca, l.localidade, m.caminho 
                            FROM cms_marcas m
                            LEFT JOIN cms_localidades l ON l.idlocalidade = m.idlocalidade
                            WHERE 
                            m.idprodutor LIKE $id OR 
                            m.idprodutorsecundario LIKE $id OR 
                            m.idprodutorterciario LIKE $id OR
                            m.idprodutorquaternario LIKE $id 
                            ORDER BY m.idmarca";

                            $sql = $db->query($sql);
                            ?>

                            <div class="form-body profile-table-body">
                                <table class="profile-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Imagem</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($linha = $db->fetchArray($sql)) {
                                            $idmarca = $linha['idmarca'];
                                            $caminho = $linha['caminho'];
                                            echo "
                                            <tr>
                                                <td style='font-weight: bolder;'>$idmarca</td>
                                                <td class='data-image'>
                                                    <div class='image-for-table'>
                                                        <img src='$caminho' alt='' class='table-img'>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class='actions'>
                                                        <a href='/pmb_marca_detalhe.php?idmarca=$idmarca' class='view'><span class='fas fa-eye'></span></a>
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
                        <div class="profile-item-row profile-signs">
                            <div class="profile-signs-title">
                                <h2>Sinais do produtor</h2>
                            </div>
                            <?php
                            $sql = "SELECT s.idsinal, l.localidade, s.caminho 
                            FROM cms_sinais s
                            LEFT JOIN cms_localidades l ON l.idlocalidade = s.idlocalidade
                            WHERE 
                            s.idprodutor LIKE $id OR 
                            s.idprodutorsecundario LIKE $id OR 
                            s.idprodutorterciario LIKE $id OR
                            s.idprodutorquaternario LIKE $id 
                            ORDER BY s.idsinal";
                            $sql = $db->query($sql);
                            ?>

                            <div class="form-body profile-table-body">
                                
                                <table class="profile-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Imagem</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        while ($linha = $db->fetchArray($sql)) {
                                            $idsinal = $linha['idsinal'];
                                            $caminho = $linha['caminho'];
                                            echo "
                                            <tr>
                                                <td style='font-weight: bolder;'>$idsinal</td>
                                                <td class='data-image'>
                                                    <div class='image-for-table'>
                                                        <img src='$caminho' alt='' class='table-img'>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class='actions'>
                                                        <a href='/pmb_sinal_detalhe.php?idsinal=$idsinal' class='view'><span class='fas fa-eye'></span></a>
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
                    <div class="profile-bottom">
                        <div class="profile-bottom-title">
                            <h2>Ações</h2>
                        </div>
                        <div class="profile-actions">

                            <div class="profile-actions-row">
                                <a href="#" class="back"><i class="fas fa-arrow-left"></i></a>
                                <a href="#" class="edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="delete"><i class="fas fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>






<?php
require_once('pmb_rodape.php');
?>