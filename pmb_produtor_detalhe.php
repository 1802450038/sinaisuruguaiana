<?php

require_once('pmb_cabecalho.php');

// $id = anti_injection($_GET['id']);


?>

<div class="body">
    <?php
    $id = (int)$_GET['id'];

    $query = "SELECT l.localidade, p.nome, p.cpf, p.ie, p.endereco, p.telefone, p.data_cadastro, p.data_atualizacao 
	FROM cms_produtores p
	LEFT JOIN cms_localidades l ON l.idlocalidade = p.idlocalidade
	WHERE idprodutor = $id";
    $sql = $db->query($query);
    $linha = $db->fetchArray($sql);
    $localidade = $linha['localidade'];
    $nome = $linha['nome'];
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
                        <div class="profile-img">
                            <img src="brasao.jpg" alt="" srcset="">
                        </div>
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