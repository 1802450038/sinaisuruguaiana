<?php
require_once('pmb_cabecalho.php');

?>

<script>
    function valida_exc_sinal() {
		var retorno = confirm('Confirma exclusao da marca?');
        
		return (retorno);
	}
    
</script>


<div class="body">
    <?php
    $idmarca = (int)($_GET['idmarca']);

    $query = "SELECT 
    l.localidade, 
    p.nome,
    ps.nome AS nomesecundario,
    pt.nome AS nometerciario,
    pq.nome AS nomequaternario,
    m.numero,
    m.observacao, 
    m.caminho, 
    m.data_cadastro,
    m.data_atualizacao,
    m.data_validade

	FROM cms_marcas m
	LEFT JOIN cms_localidades l ON l.idlocalidade = m.idlocalidade
    LEFT JOIN cms_produtores p ON p.idprodutor = m.idprodutor
    LEFT JOIN cms_produtores ps ON ps.idprodutor = m.idprodutorsecundario
    LEFT JOIN cms_produtores pt ON pt.idprodutor = m.idprodutorterciario
    LEFT JOIN cms_produtores pq ON pq.idprodutor = m.idprodutorquaternario
	WHERE idmarca = " . $idmarca;

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
        <h2>Marca</h2>
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
                            <h1><?php echo "$idmarca" ?></h1>
                        </div>
                    </div>
                    <div class="profile-middle">
                        <div class="profile-item-row profile-values">
                            <div class="profile-items-title">
                                <h2>Dados da Marca</h2>
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
                                        <h4>Valido até</h4>
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
                    <div class="profile-bottom">
                        <div class="profile-bottom-title">
                            <h2>Ações</h2>
                        </div>
                        <div class="profile-actions">

                            <div class="profile-actions-row">
                                <a href="/pmb_marca.php" class="back"><i class="fas fa-arrow-left"></i></a>
                                <a href="/pmb_marca_editar.php?id=<?php echo $idmarca?>" class="edit"><i class="fas fa-edit"></i></a>
                                <a href="/pmb_marca_excluir.php?id=<?php echo $idmarca?>" class="delete" onClick='return valida_exc_marca()'><i class="fas fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once ('pmb_rodape.php');
?>