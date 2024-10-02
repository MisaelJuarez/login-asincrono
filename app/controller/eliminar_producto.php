<?php
session_start();

if (isset($_POST['idInput'])) {
    $id = $_POST['idInput'];

    if (isset($_SESSION['producto'])) {
        foreach ($_SESSION['producto'] as $key => $producto) {
            if ($producto['id'] == $id) {
                // Elimina el producto que coincide con el ID
                unset($_SESSION['producto'][$key]);
                // Reindexa el array para que no queden huecos
                $_SESSION['producto'] = array_values($_SESSION['producto']);

                echo json_encode([
                    "status" => "success",
                    "message" => "Producto eliminado correctamente"
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
        "message" => "ID del producto no recibido"
    ]);
}

?>