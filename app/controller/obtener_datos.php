<?php
session_start();

if (!isset($_SESSION['producto'])) {
    echo json_encode([0,'Tu carrito esta vacio']);
} else {
    echo json_encode([1,$_SESSION['producto']]);
}

?>