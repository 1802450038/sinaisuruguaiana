<?php

require_once('pmb_cabecalho.php');

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "select idlocalidade, idprodutor, observacao, numero, caminho from cms_sinais where idsinal = " . $id;
	//$result = pg_query($conect, $sql)
	//or die("Nao foi possivel conectar no banco de dados!");

	$sql = $db->query($sql);

	//$linha = pg_fetch_array ( $result );
	$linha = $db->fetchArray($sql);
	$local = $linha['idlocalidade'];
	$produtor = $linha['idprodutor'];
	$numero = $linha['numero'];
	$caminho = $linha['caminho'];
	$observacao = $linha['observacao'];
} else {
	$id = "";
	$local = "";
	$produtor = "";
	$caminho = "";
	$observacao = "";
}


?>



<div class="body">
	<div class="body-title">
		<h2>Cadastrar Sinal</h2>
	</div>
	<div class="body-content">
		<div class="search-bar">
			<form action="p mb_sinal_salvar.php" enctype="multipart/form-data" method="post" name="formulario" onSubmit="return validadados()">
				<div class="form-body">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div class="form-item">
						<div class="form-item-input">
							<label class="form-item-input-label" for="arquivo">Selecione uma imagem</label>
							<?php
							if (isset($_GET['id'])) {
								echo "
											<div class='file-input'>
											<div class='preview'>
												<img class='input-preview' src='{$caminho}' >
												</div>
												<div class='input-box'>
													<label class='input-box-label' for='arquivo'>Selecione uma imagem</label>
													<input type='file' name='arquivo' id='arquivo' class='file-selector' value='$caminho' onchange='photoPreview(event)'>
												</div>
											</div>
												";
							} else {
								echo "
										<div class='file-input'>
										<div class='preview'>
										<img class='input-preview' src='' >
										</div>
										<div class='input-box'>
											<label class='input-box-label' for='arquivo'>Selecione uma imagem</label>
											<input type='file' name='arquivo' id='arquivo' class='file-selector' value='' onchange='photoPreview(event)'>
										</div>
									</div>
										";
							}
							?>
						</div>
					</div>
					<div class="form-item">
						<div class="form-item-input">
							<label class="form-item-input-label" for="localidade">Selecione a Cidade</label>
							<select name="localidade" id="localidade">
								<?php
								require_once('pmb_conecta.php');

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
							<label class="form-item-input-label" for="produtor">Selecione o Produtor</label>
							<select name="produtor" id="produtor">
								<?php
								require_once('pmb_conecta.php');
								$sql = "select idprodutor, nome from cms_produtores order by nome";
								$sql = $db->query($sql);
								echo "<option value='' selected>SELECIONE</option>";
								while ($linha = $db->fetchArray($sql)) {
									if (isset($_POST['produtor'])){
										if ($linha['idprodutor'] == $_POST['produtor'])
											echo "<option value=" . $linha['idprodutor'] . " selected>" . $linha['nome'] . "</option>";
										else
											echo "<option value=" . $linha['idprodutor'] . ">" . $linha['nome'] . "</option>";
									}else if (isset($_GET['id'])){
										if ($linha['idprodutor'] == $produtor)
											echo "<option value=" . $linha['idprodutor'] . " selected>" . $linha['nome'] . "</option>";
										else
											echo "<option value=" . $linha['idprodutor'] . ">" . $linha['nome'] . "</option>";
									}
									else
										echo "<option value=" . $linha['idprodutor'] . ">" . $linha['nome'] . "</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-item">
						<div class="form-item-input">
							<label class="form-item-input-label" for="observacao">Observação</label>
							<?php
							if ($observacao) {
								echo ("<input name='observacao' id='observacao' type='text' class='form-item-input-text' value='$observacao'>");
							} else {
								echo ("<input name='observacao' id='observacao' type='text' class='form-item-input-text'>");
							}
							?>


						</div>
					</div>
					<div class="form-item">
						<div class="form-item-input-group">
							<div class="checkgroup">
								<label for="numero">Numero</label>
								<input name="numero" id="numero" type="checkbox" class="checkmark">
							</div>
						</div>
					</div>
					<div class="form-item">
						<div class="form-item-input-action">
							<input class="clear-btn" type="reset" value="Limpar">
							<input class="save-btn" type="submit" value="Salvar">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js " integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin=" anonymous " referrerpolicy="no-referrer "></script>
<script>

	function photoPreview(elem) {

		let fileName = elem.target.files[0]["name"]
		let photoPreview = elem.path[1].children[0];
		photoPreview.innerText = fileName
		let photoPreviewBox = elem.path[1].parentElement.children[0].children[0];
		console.log(photoPreviewBox);
		photoPreviewBox.src = URL.createObjectURL(elem.target.files[0]);

	}
</script>

</html>









