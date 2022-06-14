<?php
require_once ('pmb_ver_cabecalho.php');
?>

<script>
    function acao(posicao) {
	formulario.action = 'pmb_cms_ver_sinal.php?posicao=' + posicao;	
	
    }

</script>

<div class="body">
	<div class="body-title">
		<h2>Sinais</h2>
	</div>
	<div class="body-content">
		<div class="search-bar">
			<form method="post" action="pmb_ver_sinal.php" name="formulario">
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

									if (strlen($_POST['localidade']) > 0) {
										if ($linha['idlocalidade'] == $_POST['localidade']) {
											echo "<option value=" . $linha['idlocalidade'] . " selected>" . $linha['localidade'] . "</option>";
										} else {
											echo "<option value=" . $linha['idlocalidade'] . ">" . $linha['localidade'] . "</option>";
										}
									} else if (isset($_GET['search']) && strlen($_GET['search']) > 0 && $_GET['search'] == 'l.idlocalidade') {
										if ($linha['idlocalidade'] == $_GET['term']) {
											echo "<option value=" . $linha['idlocalidade'] . " selected>" . $linha['localidade'] . "</option>";
										} else {
											echo "<option value=" . $linha['idlocalidade'] . ">" . $linha['localidade'] . "</option>";
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
							<label class="form-item-input-label" for="nome">Nome Produtor</label>
							<?php
							if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {
								echo ("<input name='nome' id='nome' type='text' class='form-item-input-text' value='" . $_POST['nome'] . "'>");
							} else if (isset($_GET['search']) && strlen($_GET['search']) > 0 && $_GET['search'] == "p.nome") {
								echo ("<input name='nome' id='nome' type='text' class='form-item-input-text' value='" . $_GET['term'] . "'>");
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
                                                <option value='1002'>1002</option>
                                            ";
								?>
							</select>
						</div>
					</div>
					<div class="form-item">
						<div class="form-item-input">
							<input class="search-btn" type="submit" value="Buscar">
						</div>
						<div class="form-item-input">
							<input class="search-btn" type="reset" value="Limpar">
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

				$search = "s.idsinal";
				$term = "";


				if (strlen($_POST['localidade']) > 0) {
					$term =  (int)$_POST['localidade'];
					$search = "l.idlocalidade";
				} else if (isset($_GET['search']) && strlen($_GET['search']) > 0 && $_GET['search'] == "l.idlocalidade") {
					$search = $_GET['search'];
					$term = $_GET['term'];
				}

				if ($_POST['nome']) {
					$search = "p.nome";
					$term =  $_POST['nome'];
				} else if (isset($_GET['search']) && strlen($_GET['search']) > 0 && $_GET['search'] == "p.nome") {
					$search = $_GET['search'];
					$term = $_GET['term'];
				}



				$start = ($page - 1) * $itemsPerPage;


				if ($_POST['nome'] || isset($_GET['search']) && strlen($_GET['search']) > 0 && $_GET['search'] == "p.nome") {
					$query = "SELECT SQL_CALC_FOUND_ROWS
                    s.idsinal, 
					s.observacao, 
                    l.localidade, 
                    p.nome, 
                    ps.nome AS nomesecundario,
                    pt.nome AS nometerciario,
                    pq.nome AS nomequaternario,
                    s.caminho,
					s.numero
                    FROM cms_sinais s
                    LEFT JOIN cms_localidades l ON l.idlocalidade = s.idlocalidade
                    LEFT JOIN cms_produtores p ON p.idprodutor = s.idprodutor
                    LEFT JOIN cms_produtores ps ON ps.idprodutor = s.idprodutorsecundario
                    LEFT JOIN cms_produtores pt ON pt.idprodutor = s.idprodutorterciario
                    LEFT JOIN cms_produtores pq ON pq.idprodutor = s.idprodutorquaternario
                    WHERE 
                    p.nome LIKE     '$term%' OR 
                    ps.nome LIKE    '$term%' OR
                    pt.nome LIKE    '$term%' OR
                    pq.nome LIKE    '$term%'
                    ORDER BY p.nome, ps.nome, pt.nome, pq.nome, s.numero LIMIT $start, $itemsPerPage";
				
				} else {
					$query = "SELECT SQL_CALC_FOUND_ROWS
					s.idsinal, 
					s.observacao, 
					l.localidade, 
					p.nome,
					ps.nome AS nomesecundario,
                    pt.nome AS nometerciario,
                    pq.nome AS nomequaternario,
					s.numero,
					s.caminho 
					FROM cms_sinais s
					LEFT JOIN cms_localidades l ON l.idlocalidade = s.idlocalidade
					LEFT JOIN cms_produtores p ON p.idprodutor = s.idprodutor
					LEFT JOIN cms_produtores ps ON ps.idprodutor = s.idprodutorsecundario
                    LEFT JOIN cms_produtores pt ON pt.idprodutor = s.idprodutorterciario
                    LEFT JOIN cms_produtores pq ON pq.idprodutor = s.idprodutorquaternario
					WHERE $search LIKE '$term%' ORDER BY p.nome, s.idsinal LIMIT $start, $itemsPerPage";
				}



				$rows = "SELECT FOUND_ROWS() AS nrtotal;";


				$query = $db->query($query);
				$rows = $db->query($rows);

				$rows = $db->fetchArray($rows);

				$total = (int)$rows[0];

				$pages = ceil($total / $itemsPerPage);


				$links = array();

				for ($i = 1; $i <= $pages; $i++) {
					array_push($links, [
						'link' => '/pmb_ver_sinal.php?' . http_build_query([
							'page' => $i,
							'quantity' => $itemsPerPage,
							'search' => $search,
							'term' => $term
						]),
						'text' => $i
					]);
				}

				while ($linha = $db->fetchArray($query)) {

					$idsinal = $linha['idsinal'];
					$localidade = $linha['localidade'];
					$produtor = $linha['nome'];
					$produtorsecundario = $linha['nomesecundario'];
                    $produtorterciario = $linha['nometerciario'];
                    $produtorquaternario = $linha['nomequaternario'];
					$numero = $linha['numero'];
					$observacao = $linha['observacao'];
					$caminho = $linha['caminho'];

					echo "<div class='card'>
                                    <div class='card-img'>
                                        <a href= 'pmb_sinal_detalhe.php?idsinal=$idsinal'>
                                            <img src='{$caminho}' alt='' srcset=''>
                                        </a>
                                    </div>
                                    <div class='card-bottom'>
                                        <div class='card-title'>
                                            <div class='title-type'>Sinal</div>
                                            <div class='title-number'>
                                                {$idsinal}
                                            </div>
                                        </div>
                                        <div class='card-items'>





										<div class='item' style='height: 100px;'>";
										if ($produtorsecundario) {
											echo "
																			<div class='item-name'>Produtores</div>
																			<div class='item-value prod' style='line-height: 18px; padding-bottom: 10px;'>{$produtor}<br>
																										{$produtorsecundario}<br>
																										{$produtorterciario}<br>
																										{$produtorquaternario}
																										</div>
																		";
										} else {
											echo "
																			<div class='item-name'>Produtor</div>
																			<div class='item-value prod'>{$produtor}</div>";
										}
										echo "
																</div>




                                            <div class='item'>
                                                <div class='item-name'>Localidade</div>
                                                <div class='item-value'>{$localidade}</div>
                                            </div>
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


				echo "<a href='{$links[0]['link']}' class='paginatior-item'><<</a>";

				if ($links[$page - 2]) {
					$genLink = "<a href='{$links[$page - 2]['link']}' class='paginatior-item' style='color:grey; border-color: grey;'>{$links[$page - 2]['text']}</a>";
					echo $genLink;
				}

				for ($j = $page; $j < ($page + 4); $j++) {
					if ($links[$j - 1]) {

						$genLink = "<a href='{$links[$j - 1]['link']}' class='paginatior-item'>{$links[$j - 1]['text']}</a>";
						echo $genLink;
					}
				}



				echo "<a href='{$links[$pages - 1]['link']}' class='paginatior-item'>>></a>";
				?>
			</div>
		</div>
	</div>
</div>


<?php
    require_once ('pmb_rodape.php');
?>