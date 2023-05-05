<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gerenciamento_de_docs";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // define o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem sucedida";
} catch(PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
}

// Coleta os dados do formulário
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

// Verifica se a senha e a confirmação de senha são iguais
if(empty($_POST['nome'])) {
    echo "Por favor, preencha o campo nome.";
}
if(empty($_POST['email'])) {
    echo "Por favor, preencha o campo Email.";
}
if(empty($_POST['senha'])) {
    echo "Por favor, preencha o campo Senha.";
} 
 if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // passo 3: preparar a instrução SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    // passo 4: executar a instrução SQL
    try {
        $stmt->execute();
        echo "Registro inserido com sucesso!";
    } catch(PDOException $e) {
        echo "Erro ao inserir registro: " . $e->getMessage();
    }
}
header('location: index.html');
die;
?>