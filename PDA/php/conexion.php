<?php 
    $server ="localhost";
    $user = "root";
    $password = "";
    $db="Routify";
    $conexion = new mysqli($server,$user,$password,$db);

    if($conexion->connect_error){
        die("No hay sistema, Prende el XAMPP");
    }

?>