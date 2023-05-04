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
} else {
    // Insere as informações do usuário no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha)
            VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conn, $sql)) {
        echo "Usuário cadastrado com sucesso";
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>