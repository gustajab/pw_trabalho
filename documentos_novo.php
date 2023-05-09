<?php
# documentos_novo.php
require('twig_carregar.php');
require('func/sanitize_filename.php');
require('func/verifica_nome_arquivo.php');
require('verifica_sessao.php');
require('models/Model.php');
require('models/Documento.php');

if(isset($_POST["enviar"])) {
    $arquivo = $_FILES["arquivo"];
  
    // Verifica se o arquivo é válido
    if ($arquivo["error"] == UPLOAD_ERR_OK) {
      // Define o diretório onde o arquivo será armazenado
      $diretorio = "uploads/";
      $caminho = $diretorio . $arquivo["name"];
  
      // Faz o upload do arquivo para o servidor
      move_uploaded_file($arquivo["tmp_name"], $caminho);
  
      // Insere as informações do documento no banco de dados
      $nome = $_POST["nome"];
      $data_up = $_POST["data_up"];
      $id_usuario = $_SESSION["nome"];
  
      $conexao = mysqli_connect("localhost", "root", "", "gerenciamento_de_docs");
      $query = "INSERT INTO documentos (nome, data_upload, id_usuario) VALUES ('$nome', '$data_up', $id_usuario)";
      mysqli_query($conexao, $query);
      mysqli_close($conexao);
    }
  }
  

if($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']){

    $arquivo = sanitize_filename($_FILES['arquivo']['name']);
    
    $arquivo = verifica_nome_arquivo('uploads/', $arquivo);

    move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo);

    $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $data_formatada = $agora->format('Y-m-d H:i:s');

        $doc = new Documento();
        $doc->create([
            'nome' => $_POST['nome'],
            'id_usuario' => $_SESSION['nome'],
            'data' => $data_formatada
            ]);
          
            header('location: listagem.php');
    
}

    echo $twig->render('documentos_novo.html');

