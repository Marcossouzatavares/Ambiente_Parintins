<?php
    include_once "cabecalho.php";
?>
<div id="divconteudo">

<p>Por favor, selecione o tipo do material que você deseja descartar, que mostraremos para você os pontos de coleta.</p> 
    <form method="POST">
      <select name="id_material">

        <?php
     
            require_once "conexao.php";
            $sql = "SELECT * FROM materiais";
            $result = $mysqli->query($sql);
            echo "<option value='0'>Selecione um material</option>";
            while($materiais = $result->fetch_assoc()){
                $id = $materiais['id'];
                $nome = $materiais["nome"];
                echo "<option value='$id'>$nome </option>";
            }    
        ?>
       </select>
            <input type="submit" name="bt_enviar" value="Pesquisar">
    </form>

</p>

<?php

if(isset($_POST['bt_enviar'])){
    $id_material = $_POST["id_material"];
    //se o usuario não selecionar nenhum ponto de coleta e apertar em "Pesquisar"
    if($id_material==0){
        echo "<p>Por favor, selecione um material.</p>";
    }else{
        //pega o nome do material
        $sql = "SELECT nome FROM `materiais` WHERE id = $id_material";
        $result = $mysqli->query($sql);
        $material = $result->fetch_row()[0];

        //consulta pontos de coleta
        $sql = "SELECT * FROM pontos_coleta,lista_materiais
                WHERE lista_materiais.pontos_coleta_id = pontos_coleta.id
                AND lista_materiais.materiais_id = $id_material";
         //mostra os pontos disponiveis no banco       
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            echo "<h2>Pontos de coleta para $material</h2>";
            while($pontos_coleta = $result->fetch_assoc()){
                echo "<h3>".$pontos_coleta["nome"]."</h3>";
               echo '<img 
                width="40%" height="80%" src="'.$pontos_coleta['imagem'].'" alt="">';
                echo "<br>Endereço: ".$pontos_coleta["endereco"];
                echo "<br>Horario: ".$pontos_coleta["horario"];
                echo "<br>Contato: ".$pontos_coleta["telefone"];
            }
        }else{
            echo "<p>Não temos pontos de coleta para esse tipo de material.</p>";
        }
    }
}
?>

