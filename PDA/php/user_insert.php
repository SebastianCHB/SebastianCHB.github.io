<?php
include "./conexion.php";
    $name = $_POST['txtName'];
    $email= $_POST['txtEmail'];
    $pass = $_POST['txtPassword'];


    $con ="INSERT INTO users VALUES (0,'$name',1, '$email', '$pass')";

        echo $con;
        $conexion -> query($con) or die($conexion -> error);
    
    header("Location: ../users.php?status=1");
?>