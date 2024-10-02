<?php
session_start();

if (isset($_POST['nombre_p']) && !empty($_POST['nombre_p']) && 
    isset($_POST['precio_p']) && !empty($_POST['precio_p'])) {

    if (!isset($_SESSION['producto'])) {
        $_SESSION['producto'] = [];
    }

    $idInput = $_POST['idInput'];
    $nombreProducto = $_POST['nombre_p'];
    $precioProducto = $_POST['precio_p'];

    $_SESSION['producto'][] = ['id' => $idInput, 'nombre' => $nombreProducto, 'precio' => $precioProducto];

    echo json_encode([1,"Producto registrado"]);
    
} else {
    echo json_encode([0,"No puedes dejar campos vacios"]);
}

?>