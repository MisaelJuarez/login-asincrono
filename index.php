<!-- login, registro, cerrar sesion -->

<?php
session_start();
require_once("./app/config/dependencias.php");
require_once("./app/controller/inicio.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS."bootstrap.min.css";?>">
    <link rel="stylesheet" href="<?=CSS."inicio.css";?>">
    <link rel="stylesheet" href="<?=ICONS."bootstrap-icons.css";?>">
    <title>Formulario de datos</title>
</head>
<body class="vh-100">
    <div class="row">
        <div class="col"></div>
        <div class="col mt-5 p-5 c-datos">
            <h1 class="text-center text-white mb-5">Bienvenido <i class="bi bi-emoji-sunglasses-fill"></i></h1>
            <h2 class="text-center text-white"><?= $_SESSION['registro']['nombre']." ".$_SESSION['registro']['apellido'];?> </h2>
            <p class="text-center text-white fs-4 mb-4"><?= $_SESSION['registro']['email'] ?></p> 
            <div class="d-flex justify-content-center">
                <a href="./cerrar_sesion.php" class="btn btn-danger">Cerrar sesion</a>
            </div>
        </div>
        <div class="col"></div>
    </div>
</body>
</html>