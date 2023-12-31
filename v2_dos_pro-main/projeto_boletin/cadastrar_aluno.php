<?php
include_once "conexao.php"; // Certifique-se de incluir o arquivo de conexão adequado aqui

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo 'nome' foi enviado no formulário
    if (isset($_POST["nome"])) {
        // Sanitize e obtem o valor do campo 'nome'
        $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);

        $materias = $_POST['materias'];

        // Prepara e executa a consulta SQL para inserir o nome na tabela
        if($_GET['idc']==1){
            $sql = "INSERT INTO primeiro (nome,materias) VALUES ('$nome','$materias')";
        }else if($_GET['idc']==2){
            $sql = "INSERT INTO segundo (nome,materias) VALUES ('$nome','$materias')";
        }else if($_GET['idc']==3){
            $sql = "INSERT INTO terceito (nome,materias) VALUES ('$nome','$materias')";
        }
        

        if ($conexao->query($sql) === TRUE) {
            echo "Nome inserido com sucesso!";
        } else {
            echo "Erro na inserção do nome: " . $conexao->error;
        }

        // Fecha a conexão com o banco de dados
    } else {
        echo "O campo 'nome' não foi preenchido no formulário.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Inserir Nome</title>
</head>
<body>
    <h1>Inserir Nome</h1>

    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <?php 
            $sql = "SELECT materia FROM materias";
            $result = $conexao->query($sql);
            echo " <select id='materias' name='materias'>";
            echo "<option value='indefinido'></option>";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['materia'] . "'>" . $row['materia'] . "</option>";
                }   
            }
            echo " </select>";
        ?>
        <input type="submit" value="Inserir">
    </form>
</body>
</html>
