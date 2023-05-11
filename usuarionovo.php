<?php
require('verifica_sessao.php');
require('models/Model.php');
require('models/Usuario.php');

$nome = $_POST['nome'] ?? false;
$senha = $_POST['pass'] ?? false;
$email = $_POST['email'] ?? false;



$usr = new Usuario();
$usr->create([
    'nome' => $nome,
    'email' => $email,
    'senha' => $senha,
]);

header('location: usuarios.php');

