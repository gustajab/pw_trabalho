<?php
//----------------------------------------------------------------------------------
  
  //altera documento
  function altera_documento($nome, $caminho, $dataupload, $id)
  {
  require('pdo.inc.php');
         
  
          //Realiza o altera DOS ALUNOS
          $sql = $conex->prepare("UPDATE documentos SET nome = :nome, caminho = :caminho, data_upload = :dataupload WHERE id_documentos = :id");
  
          $sql->bindParam(':nome', $nome);
          $sql->bindParam(':caminho', $caminho);
          $sql->bindParam(':dataupload', $dataupload);
          $sql->bindParam(':id', $id);      
          $sql->execute();

  }