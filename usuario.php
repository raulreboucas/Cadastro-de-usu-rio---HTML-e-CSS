<?php

Class Usuario
{
	private $pdo;
	public $msgErro = "";
	
	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		try 
		{
			$pdo = new PDO("epiz_26861011_brazuca","sql103.epizy.com", "$epiz_26861011", "oQgcVT1z5TkINJ2");	
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
	}
	
	public function cadastrar($nome, $email, $vive, $morar, $senha)
	{
		global $pdo;
		//verificar se já existe email cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e",$email);
		$sql->execute();
		if($sql->rowCount() > 0)	 
		{
			return false; //já está cadastrado
		}
		else
		{
			//caso não, Cadastrar
			$sql = $pdo->prepare("INSERT INTO usuarios(nome, email, vive, morar, senha) VALUES (:n, :e, :v, :m, :s)");
			$sql->bindValue(":n",$nome);
			$sql->bindValue(":e",$email);
			$sql->bindValue(":v",$vive);
			$sql->bindValue(":m",$morar);
			$sql->bindValue(":s",md5($senha));
			$sql->execute();
			return true; 
		}
	}

	public function logar ($email, $senha)
	{
		global $pdo;
		//verificar se o email e senha estao cadastrados, se sim
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
		$sql->bindValue(":e",$email);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			//entrar no sistema (sessao)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario']; //armazenamento do usuario no banco, para acessar a página privada.
			return true; //Logado com sucesso.
		}
		else
		{
			return false; //não foi possível logar
		}
	}
}


?>
