
   <?php
	session_start();
    include_once "cabecalho.php";
	echo '<div id="divconteudo">';

	if(isset($_POST["bt_logar"])){
		require_once "conexao.php";
		$email = $_POST["email"];
		$senha = $_POST['senha'];
		$sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
		$result =  $mysqli->query($sql) or die("Erro de login");
	
		//verifica se o o usuario está logado, senão, direciona para a tela de login
		if($result->num_rows == 1){
			$usuario = $result->fetch_assoc();
			$_SESSION["nome"] = $usuario['nome'];
			$_SESSION["id_usuario"] = $usuario['id'];
			$_SESSION["logado"]=true;
		}else{
		
		//login
			echo "<p>Você ainda não está cadastrado. Por favor, faça seu cadastro.</p>";
			echo '<form method="POST">';
			echo '<p>Nome: <input type="text" name="nome" required></p>';
			echo '<p>E-mail: <input type="email" name="email" required><p>';	
			echo '<p>Senha: <input type="password" name="senha" required></p>';
			echo '<input type="submit" name="bt_cadastrar" value="Cadastrar">';
			echo '</form>';
			
		}
	}

    //guardando os dados da tela de login
	if(isset($_POST['bt_cadastrar'])){
		require_once "conexao.php";
		$nome  = $_POST['nome'];
		$email = $_POST["email"];
		$senha = $_POST['senha'];
		$sql = "INSERT INTO usuario(nome,senha,email)values('$nome','$senha', '$email')";
		$result = $mysqli->query($sql);
		if(!$result or $mysqli->affected_rows !=1){
			echo "erro durante insert <br> erro em: $sql";
		}else{
			echo "<p>Cadastro realizado com sucesso. Agora Cadastre o seu ponto de coleta.</p>";
		}
	}

	// se logado, pode cadastrar novos pontos de coleta

	if(isset($_POST['bt_cadponto'])){
		require_once "conexao.php";
		//Parte 1 : cadastro dos dados que irão para a tabela  pontos de coleta
        $nome = $_POST["nome"];
		$endereco = $_POST["endereco"];
		$telefone = $_POST["telefone"];
		$email= $_POST["email"];
		$hora =$_POST["horario"];

		$sql = "INSERT INTO pontos_coleta(nome,endereco,telefone,email,horario) values('$nome','$endereco','$telefone','$email','$hora')";

		$result = $mysqli->query($sql);
		if(!$result or $mysqli->affected_rows !=1){
			echo "erro durante insert <br> erro em: $sql";
		}
		if ($mysqli->query($sql)===TRUE){
			$id_ponto = $mysqli-> insert_id;

			echo"Tudo pronto!   muito obrigado por cadastrar mais um ponto de coleta no nosso site, você acabou de contribuir com a preservação do meio ambiente Parintinense!";
		}else{
			echo"Error: ". $sql."<br>" . $mysqli->error;
		}

		//Parte 3: cadastro  dos dados que irão para a tabela lista_materiais.
			$materiais = $_POST["materiais"]; //  materiais é um vetor
			foreach($materiais as $id_material){
		//Recuperação do id do último insert 
			$sql = "INSERT INTO lista_materiais(pontos_coleta_id,materiais_id) values('$id_ponto','$id_material')";
        echo"<br>";
        $result = $mysqli->query($sql);
        if(!$result or $mysqli->affected_rows !=1){
	    echo "erro durante insert <br> erro em: $sql";
        }
    }
	}
	if(isset($_SESSION["logado"]) and $_SESSION["logado"]===true){ 
		echo '<form method="POST" action="#">';
		echo '<p>Cadastre o seu Ponto de Coleta.</p>';
		echo '<p>Nome: <input type="text" name="nome"><br>';
		echo '<p>Endereço: <input type="text" name="endereco"><br>';
		echo '<p>Telefone: <input type="number" name="telefone"><br>';
		echo '<p>E-mail: <input type="email" name="email"><br>';
		echo '<p>Horario de atendimento: <input type="text" name="horario">';

		
		echo "<p>Quais os Materiais reciclados no seu ponto de coleta? selecione-os por favor:</p>";
		// listar materiais aqui
		$sql = "SELECT * FROM `materiais` ";
		require_once "conexao.php";
        $result = $mysqli->query($sql);
		
		while(list($id,$nome) = $result->fetch_row()) {
		
				echo"<input type='checkbox' name='materiais[]' value='$id'> $nome<br>";
					
		}//fim while

		echo '<br><br><input type="submit" name="bt_cadponto" value="Enviar dados">';
		echo '</form>';
	}else{
		echo '<form method="POST">';
		echo '<p>E-mail: <input type="email" name="email" required><p>';	
		echo '<p>Senha: <input type="password" name="senha" required></p>';
		echo '<input type="submit" name="bt_logar" value="Entrar">';
		echo '</form>';
	}
	echo '</div>';

	?>	