<?php
	session_start();
	if(!isset($_SESSION['id_usuario']))
	{
		header_remove("location: index.php");
		exit;
	}
?>


SEJA BEM VINDO Brazucas !!!!!
<a href="sair.php"> Sair </a>
