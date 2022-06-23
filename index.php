<?php
/*

 @author Rafael Rodrigues Bastos
 @updated 01/12/2012 by Alex Camargo
 @updated 01/05/2022 by GABRIEL BELLAGAMBA 
	|NOK - NADA OK| 
	|POK - PARCIALMENTE OK| 
	|TOK - TOTALMENTE OK|
	-> @GB {
		+ Adicionado o campo Observação em marca [TOK]
		+ Adicionado o campo Observação em sinal
		- Removido a função anti_injection() de todos $_GET['id']
		  e adicionado um cast de int para evitar sql inject [TOK]
		+ Adicionado paginação para marcas [NOK]
		+ Adicionado paginação para sinais [NOK]
	}
 @GABRIEL PEREIRA BELLAGAMBA - gabriel.chaus@gmail.com

 Controle de Marcas e Sinais

 Copyright (C) 2008 PMB - Prefeitura Municipal de Bag�
                          webmaster@bage.rs.gov.br

 Este arquivo � parte do programa Controle de Marcas e Sinais.
 
 Controle de Marcas e Sinais � um software livre; voc� pode
 redistribui-lo e/ou modifica-lo dentro dos termos da Licen�a
 P�blica Geral GNU como publicada pela Funda��o do Software
 Livre (FSF); na vers�o 2 da Licen�a, ou (na sua opni�o)
 qualquer vers�o.

 Este programa � distribuido na esperan�a que possa ser util, mas
 SEM NENHUMA GARANTIA; sem uma garantia implicita de ADEQUA��O a
 qualquer MERCADO ou APLICA��O EM PARTICULAR. Veja a Licen�a
 P�blica Geral GNU para maiores detalhes.
 Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral GNU
 junto	com este programa, se n�o, escreva para a Funda��o do
 Software Livre (FSF) Inc., 51 Franklin St, Fifth Floor, Boston,
 MA  02110-1301 USA.

*/
require_once('pmb_conecta.php');

if ($_GET){
	if ($_GET['erro'] == 1) {
		echo '<script language="Javascript">
		alert("Usu�rio ou senha inv�lida!");
		</script>';
	}
}




// //se o usu�rio n�o estiver bloqueado (tentativas maior que 10)
// if($resultado){
// 		$dados           = array();
// 		$dados["login"]   = $login;
// 		$_SESSION['login'] = $dados["login"];
// 		$dados["senha"] = $senha;                       
// 		$_SESSION["dados"] = $dados; 
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/login.css">
	<title>Login</title>
</head>
<body>
	
<div class="login-container">
        <div class="login-body">
            <div class="login-title">
                <h2>BEM VINDO</h2>
                <h5>Login <br> Marcas & Sinais uruguaina</h5>
            </div>

            <form action="pmb_login.php" class="login-form" method="POST" name="formulario">
                <div class="form-item">
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login">
                </div>
                <div class="form-item">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha">
                </div>
                <div class="form-action">
                    <button type="reset" class="reset">Cancelar</button>
                    <button type="submit" class="login" value="ok">Login</button>
                </div>

            </form>
            <div class="form-extra">
                <a href="pmb_ver_marca.php">Consulta sem Login</a>
                <a href="#">Sobre</a>
            </div>
        </div>
    </div>

</body>
</html>