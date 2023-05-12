<?php


function search($resultado){
require('pdo.inc.php');
if ($timestamp = strtotime($resultado)) {
    $sql = $pdo->prepare('SELECT * FROM documentos WHERE DATE(data_upload) = :resultado AND usuarios_id = :id_usuario');
    $resultado =  date('Y-m-d', $timestamp);
    $sql->bindParam(':resultado', $resultado);
    $sql->bindParam(':id_usuario', $_SESSION['id_usuario']);

$sql->execute();
return $sql->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $sql = $pdo->prepare('SELECT * FROM documentos WHERE nome LIKE :resultado AND usuarios_id = :id_usuario');
    $resultado = "%$resultado%";
    $sql->bindParam(':resultado', $resultado);
    $sql->bindParam(':id_usuario', $_SESSION['id_usuario']);
$sql->execute();
return $sql->fetchAll(PDO::FETCH_ASSOC);
  }
}