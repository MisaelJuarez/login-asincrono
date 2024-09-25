<?php
    session_start(); 
    session_unset(); //liberamos la session actual
    session_destroy(); //destruimos la session
    header("location: ./login.php");
?>