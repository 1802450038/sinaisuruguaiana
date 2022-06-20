<?php
require_once ('pmb_ver_cabecalho.php');
$idsinal = (int)$_GET['idsinal'];
?>


<div class="body">
    <?php
    $idsinal = $_GET['idsinal'];

    $query = "SELECT 
    l.localidade, 
    p.nome,
    ps.nome AS nomesecundario,
    pt.nome AS nometerciario,
    pq.nome AS nomequaternario, 
    s.numero, 
    s.observacao, 
    s.caminho, 
    s.data_cadastro,
    s.data_validade
	FROM cms_sinais s
	LEFT JOIN cms_localidades l ON l.idlocalidade = s.idlocalidade
	LEFT JOIN cms_produtores p ON p.idprodutor = s.idprodutor
    LEFT JOIN cms_produtores ps ON ps.idprodutor = s.idprodutorsecundario
    LEFT JOIN cms_produtores pt ON pt.idprodutor = s.idprodutorterciario
    LEFT JOIN cms_produtores pq ON pq.idprodutor = s.idprodutorquaternario
	WHERE idsinal = " . $idsinal;

    $sql = $db->query($query);
    $linha = $db->fetchArray($sql);
    $localidade = $linha['localidade'];
    $nome = $linha['nome'];
    $produtorsecundario = $linha['nomesecundario'];
    $produtorterciario = $linha['nometerciario'];
    $produtorquaternario = $linha['nomequaternario'];
    $caminho = $linha['caminho'];
    $numero = $linha['numero'];
    $observacao = $linha['observacao'];
    $data_cadastro = $linha['data_cadastro'];
    $data_atualizacao = $linha['data_atualizacao'];
    $data_validade = $linha['data_validade'];

    ?>

    <div class="body-title">
        <h2>Sinal</h2>
    </div>
    <div class="body-content">
        <div class="search-bar">
            <div class="content">
                <div class="profile-content">
                    <div class="profile-top">
                        <div class="profile-img">
                            <img src="<?php echo $caminho ?>" alt="" srcset="">
                        </div>
                        <div class="profile-name">
                            <h1><?php echo "$idsinal" ?></h1>
                        </div>
                    </div>
                    <div class="profile-middle">
                        <div class="profile-item-row profile-values">
                            <div class="profile-items-title">
                                <h2>Dados do Sinal</h2>
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
                                <?php
                                    if($produtorsecundario){
                                        echo "
                                        <div class='profile-item'>
                                        <div class='profile-item-title'>
                                            <h4>Produtor secundário</h4>
                                        </div>
                                        <div class='profile-item-value'>
                                            <h4>$produtorsecundario</h4>
                                        </div>
                                    </div>
                                        ";
                                    }
                                    if($produtorterciario){
                                        echo "
                                        <div class='profile-item'>
                                        <div class='profile-item-title'>
                                            <h4>Produtor terciário</h4>
                                        </div>
                                        <div class='profile-item-value'>
                                            <h4>$produtorterciario</h4>
                                        </div>
                                    </div>
                                        ";
                                    }
                                    if($produtorquaternario){
                                        echo "
                                        <div class='profile-item'>
                                        <div class='profile-item-title'>
                                            <h4>Produtor quaternário</h4>
                                        </div>
                                        <div class='profile-item-value'>
                                            <h4>$produtorquaternario</h4>
                                        </div>
                                    </div>
                                        ";
                                    }

                                ?>
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
                                        <h4>observacao</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$observacao" ?></h4>
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
                                <div class="profile-item">
                                    <div class="profile-item-title">
                                        <h4>Valido  até</h4>
                                    </div>
                                    <div class="profile-item-value">
                                        <h4><?php echo "$data_validade" ?></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="profile-item-row profile-images">
                            <div class="profile-images-title">
                                <h2>Imagem</h2>
                            </div>
                            <div class="profile-image">
                            <img src="<?php echo $caminho?>" alt="" srcset="">
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