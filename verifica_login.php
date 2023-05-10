<?php
require('pdo.inc.php');
// conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gerenciamento_de_docs";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

// receber os dados do formulário
if (isset($_POST['nome']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // preparar a instrução SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nome=:nome AND senha=:senha");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':senha', $senha);

    // executar a instrução SQL
    try {
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // verificar o resultado da consulta
            // iniciar a sessão do usuário
            session_start();
            $_SESSION['id_usuario'] = $result['id_usuario'];
            echo "Login bem-sucedido!";
            header('location: listagem.php');
    die;
        } else {
            echo "Login inválido.";
        }
    } catch(PDOException $e) {
        echo "Erro ao verificar login: " . $e->getMessage();
    }
}
    
    
   
 


?>
