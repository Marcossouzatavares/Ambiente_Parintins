<?php
	session_start();
    include_once "cabecalho.php";
	echo '<div id="divconteudo">';
	
	//verifica se usuário e senha estão ok e faz o login
	if(isset($_POST["bt_logar"])){
		require_once "conexao.php";
		$email = $_POST["email"];
		$senha = $_POST['senha'];
		$sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
		$result =  $mysqli->query($sql) or die("Erro de login");
	
		//verifica se o o usuario está logado
		if($result->num_rows == 1){
			$usuario = $result->fetch_assoc();
			$_SESSION["nome"] = $usuario['nome'];
			$_SESSION["id_usuario"] = $usuario['id'];
			$_SESSION["logado"]=true;
		}else{
			echo "<p>Login e/ou senha incorretos ou você ainda não possui cadastro.</p>";
		}
	}
	
	if(isset($_GET["op"]) and $_GET["op"]==="logout"){
		//Usuário deseja fazer logout
		$_SESSION = array();
		session_unset();
		session_destroy();
		header("Location: comentarios.php");
	}

	//cadastrando um novo usuário
	if(isset($_POST['bt_cadastrar'])){
		require_once "conexao.php";
		unset($_GET["op"]);
		$nome  = $_POST['nome'];
		$email = $_POST["email"];
		$senha = $_POST['senha'];
		$sql = "INSERT INTO usuario(nome,senha,email)values('$nome','$senha', '$email')";
		$result = $mysqli->query($sql);
		if(!$result or $mysqli->affected_rows !=1){
			echo "erro durante insert <br> erro em: $sql";
		}else{
			echo "<p>Cadastro realizado com sucesso. Agora você pode acessar.</p>";	
		}
	}

	//guardando os comentários no banco de dados
	if(isset($_POST["bt_comentar"])){
		include_once "conexao.php";
		$comentario = $_POST["comentario"];
		$usuario_id = $_SESSION["id_usuario"];
		$data = date("d/m/Y");
		
		$sql = "INSERT INTO comentarios(comentario,usuario_id,dat) values('$comentario',$usuario_id,'$data')";
	    $result = $mysqli->query($sql);

		if(!$result or $mysqli->affected_rows !=1){
		echo "erro durante insert <br> erro em: $sql";
	 }else{
		//echo "usuário $usuario_id : $comentario ($data)"; //teste (pode apagar depois)
		echo '<p>'.$_SESSION["nome"].' seu comentário foi enviado, muito obrigado por interagir com a gente!  &#x1F60E </p>';
		
	 }
	}

	if(isset($_SESSION["logado"]) and $_SESSION["logado"]===true){ 
		// se logado, pode fazer o comentário
		echo '<form method="POST">';
		echo '<p>Digite o seu comentário '.$_SESSION["nome"].' <a href="?op=logout">Desconectar</a></p>';
	echo '<textarea   cols="50" rows="15" name="comentario" maxlenght=500 required></textarea><br>';
		echo '<input type="submit" name="bt_comentar" value="Enviar comentário">';
		echo '</form>';
	}elseif(isset($_GET["op"]) and $_GET["op"]==="novo_cadastro"){
		//Se escolheu 'novo cadastro' no login aprensenta o form para novo cadastro
		echo "<h3>Novo cadastro</h3>";
		echo '<form method="POST">';
		echo '<p>Nome: <input type="text" name="nome" required></p>';
		echo '<p>E-mail: <input type="email" name="email" required><p>';	
		echo '<p>Senha: <input type="password" name="senha" required></p>';
		echo '<input type="submit" name="bt_cadastrar" value="Cadastrar">';
		echo '</form>';
	}else{
		//Login - apresenta o login
		echo '<form method="POST">';
		echo "<h3>Login</h3>";
		echo '<p>E-mail: <input type="email" name="email" required><p>';	
		echo '<p>Senha: <input type="password" name="senha" required></p>';
		echo '<input type="submit" name="bt_logar" value="Entrar">';
		echo '</form>';
		echo '<br><a href="?op=novo_cadastro">Novo cadastro</a>';
	}


	echo '</div>';
?>
 



