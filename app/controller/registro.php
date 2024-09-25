<?php
session_start();

$expresion = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if (isset($_SESSION['usuario'])) {
    header("location: ./index.php");
}

if ($_POST) {
    if (isset($_POST['nombre']) && !empty($_POST['nombre']) && 
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['pass']) && !empty($_POST['pass'])) {

        if(is_numeric($_POST['nombre'])) {
            echo json_encode([0,"No puedes agregar numeros en el input nombre"]);
        } else if(is_numeric($_POST['apellido'])) {
            echo json_encode([0,"No puedes agregar numeros en el input apellido"]);
        } else if (!preg_match($expresion,$_POST['email'])) {
            echo json_encode([0,"No cumples con las especificaciones de un correo"]);
        } else {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            
            $_SESSION['registro'] = [
                "nombre" => $nombre,
                "apellido" => $apellido,
                "email" => $email,
                "pass" => $pass
            ];    
            echo json_encode([1,"Usuario registrado correctamente"]);
        }
        
    } else {
        echo json_encode([0,"No puedes dejar campos vacios"]);
    }
}



?>