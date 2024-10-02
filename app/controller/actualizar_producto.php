<?php 
session_start();

if (isset($_POST['idInput']) && isset($_POST['nombre_p']) && isset($_POST['precio_p'])) {
    $id = $_POST['idInput'];
    $nombre = $_POST['nombre_p'];
    $precio = $_POST['precio_p'];

    if (isset($_SESSION['producto'])) {
        foreach ($_SESSION['producto'] as $key => $producto) {
            if ($producto['id'] == $id) {

                $_SESSION['producto'][$key]['nombre'] = $nombre;
                $_SESSION['producto'][$key]['precio'] = $precio;

                echo json_encode([
                    "status" => "success",
                    "message" => "Producto actualizado correctamente"
                ]);
                exit;
            }
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Producto no encontrado"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Datos incompletos"
    ]);
}


?>