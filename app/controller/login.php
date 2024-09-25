<?php
session_start();

if ($_POST) {
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass'])) {

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        if (empty($_SESSION['registro'])) {
            echo json_encode([0,"Datos de acceso incorrectos"]);
        } else {
            if ($email == $_SESSION['registro']['email'] && $pass == $_SESSION['registro']['pass']) {
                $_SESSION['usuario'] = $_SESSION['registro'];
                echo json_encode([1,"Datos de acceso correctos"]);
                // header("location: ./index.php");
            } else {
                echo json_encode([0,"Datos de acceso incorrectos"]);
            }
        }
    } else {
        echo json_encode([0,"Tienes que llenar los datos en el formulario"]);
    }
}

?>