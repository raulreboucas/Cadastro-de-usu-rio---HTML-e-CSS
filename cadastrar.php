<?php
	require_once 'CLASSES/usuarios.php';
	$u = new Usuario;
?>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>BrazucApp</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
</head>
<body>
<div id="corpo-form-cad">
	<h1>Cadastrar</h1>
	<form method="POST">
		<input type="Nome" name="nome" placeholder="Nome Completo" maxlength="40">
		<input type="email" name="email" placeholder="Usuário" maxlength="30">
		<input type="vive" name="vive" placeholder="Onde vive?" maxlength="40">
		<input type="interesse" name="morar" placeholder="Cidade do seu interesse" maxlength="40">
		<input type="password" name="senha" placeholder="Senha" maxlength="10">
		<input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="10">
		<input type="submit" name="" value="Acessar">
	</form>
</div>
<?php

if(isset($_POST['nome']))
{
	$nome = addslashes($_POST['nome']);
	$email = addslashes($_POST['email']);
	$vive = addslashes($_POST['vive']);
	$morar = addslashes($_POST['morar']);
	$senha = addslashes($_POST['senha']);
	$confirmarSenha = addslashes($_POST['confSenha']);
	//verificar se esta preenchido
	if(!empty($nome) && !empty($email) && !empty($vive) && !empty($morar) && !empty($senha) && !empty($confirmarSenha))
	{
		$u->conectar("epiz_26861011_brazuca", "sql103.epizy.com", "epiz_26861011", "oQgcVT1z5TkINJ2"); 
		if($u->msgErro == "") // está tudo certo
		{
			if($senha == $confirmarSenha)
			{
				if($u->cadastrar($nome,$email,$vive,$morar,$senha,$confirmarSenha))
				{
					?>
					<div id="msg-sucesso">
					Cadastrado com sucesso! 
					</div>
					<?php
				}	
				else
				{
					?>
					<div class="msg-erro">
					E-mail já cadastrado!
					</div>
					<?php
				}
			}
			else
			{
				?>
				<div class="msg-erro">
				Senha e confirmar senha não correspondem.
				</div>
				<?php
			}	
		}
		else
		{
			?>
			<div class="msg-erro">
				<?php echo "Erro: ".$u->msgErro;?>
			</div>
			<?php
		}
	}else
	{
		?>
		<div class="msg-erro">
			<h3>Preencha todos os campos!</h3>
		</div>
		<?php
	}
}
?>
</body>
</html>