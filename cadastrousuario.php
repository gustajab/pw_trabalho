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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    // Define uma variável para controlar erros
    $erros = array();
    
    // Validação do campo nome
    if (empty($nome)) {
        $erros[] = "O campo nome é obrigatório.";
        header('location: cadastro.php');
        die;
    }
    
    // Validação do campo email
    if (empty($email)) {
        $erros[] = "O campo e-mail é obrigatório.";
        header('location: cadastro.php');
        die;
    } 
    
    // Validação do campo senha
    if (empty($senha)) {
        $erros[] = "O campo senha é obrigatório.";
        header('location: cadastro.php');
        die;
    } 
    
    // Verifica se houve algum erro
    if (count($erros) > 0) {
        // Exibe os erros para o usuário
        foreach ($erros as $erro) {
            echo $erro . "<br>";
        }
    } else {
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
    header('location: login.php');
die;
}



?>