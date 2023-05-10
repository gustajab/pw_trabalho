<?php
    # verifica_login.php
    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('location:login.php?erro=2');
        die;
    }