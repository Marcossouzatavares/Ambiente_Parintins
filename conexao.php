<?php

$localhost = "localhost";
$usuario = "root";
$senha = "";
$banco = "banco_site";

$mysqli = new mysqli($localhost,$usuario,$senha,$banco);

if($mysqli->connect_errno){
	//exibe o erro
	echo "Erro de conexão:".$mysqli->connect_error;
	exit(0);
}

?>