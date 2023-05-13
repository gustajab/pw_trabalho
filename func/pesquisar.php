<?php


function search($resultado){
require('pdo.inc.php');

    $sql = $pdo->prepare('SELECT * FROM documentos WHERE nome LIKE :resultado AND usuarios_id = :id_usuario');
    $resultado = "%$resultado%";
    $sql->bindParam(':resultado', $resultado);
    $sql->bindParam(':id_usuario', $_SESSION['id_usuario']);
$sql->execute();
return $sql->fetchAll(PDO::FETCH_ASSOC);
  }
