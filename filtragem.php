<?php
require('pdo.inc.php');
require('twig_carregar.php');

// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gerenciamento_de_docs";

// Obter o valor do campo de pesquisa
$barra_pesquisa = $_POST['barra_pesquisa'];

// Criar conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para filtrar os registros pelo nome
$sql = "SELECT * FROM documentos WHERE nome LIKE '%$barra_pesquisa%'";

// Executar a consulta
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Exibir os resultados
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id_documento"] . ", Nome: " . $row["nome"] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fechar a conexão com o banco de dados
$conn->close();

