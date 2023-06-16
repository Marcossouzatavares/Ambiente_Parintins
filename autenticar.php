<?php
session_start();
require "conexao.php";

$login = $_POST["nome"];
$senha = $_POST["senha"];
$email = $_POST["email"];

$sql = "SELECT * FROM usuario WHERE  nome='$nome' senha='$senha' AND email='$email'";

$result = $mysqli->query($sql) or die("Erro na consulta $sql");

if($result->num_rows == 1){
    $_SESSION["logado"] = true;
    $_SESSION["usuario"] = $login;
    $usuario = $result->fetch_assoc();
    $_SESSION["email"] = $usuario["email"];
    header("Location: comentarios.php");
}else{
    header("Location: usuario.php?erro=1");
}