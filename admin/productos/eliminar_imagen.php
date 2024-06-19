<?php

/**
 * Elimina imagen del producto
 * Autor: Adrian Guillen
 * Web: https://github.com/GuillenA7
 */

require '../config/config.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

$urlImagen = $_POST['urlImagen'] ?? '';

if ($urlImagen !== '' && file_exists($urlImagen)) {
    unlink($urlImagen);
}
