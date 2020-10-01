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
<div id="corpo-form">
		<h1>Entrar</h1>
	<form method="POST">
		<input type="email" name="email" placeholder="Usuário">
		<input type="password" name="senha" placeholder="Senha">
		<input type="submit" name="" value="Acessar">
		<a href="cadastrar.php">Ainda não é inscrito?<strong> Cadastre-se</strong></a>
	</form>
</div>
<?php
if(isset($_POST['email']))
{
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);

		if(!empty($email) && !empty($senha))
	{
		$u->conectar("epiz_26861011_brazuca", "sql103.epizy.com", "epiz_26861011", "oQgcVT1z5TkINJ2");
		if($u->msgErro == "")
        {
			if($u->logar($email,$senha))
			{
				header("location: areaprivada.php");
			}
			else
			{
				?>
				<div class="msg-erro">
					Email e/ou senha estão incorretos!
				</div>
				<?php
			}
		}
		else
		{
			?>
			<div class="msg-erro">
				<?php echo "Erro: ".$u->msgErro; ?>
			</div>
			<?php
		}
	}else
	{
		?>
		<div class="msg-erro">
			Preencha todos so campos!
		</div>
		<?php
	}
}
?>
</body>
</html>