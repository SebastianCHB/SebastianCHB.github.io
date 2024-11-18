<?php 
include("./conexion.php");
    echo "insertando pelao";
    $name = $_POST['txtName'];
    $apellido = $_POST['txtLast'];
    $edad = $_POST['txtEdad'];
    $estatura = $_POST['txtEstatura'];
    $peso = $_POST['txtPeso'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $passwordconfirm = $_POST['txtPasswordConfirm'];


    echo "Nombre: ".$name."<br>";
    echo "Apellido: ".$apellido."<br>";
    echo "Edad: ".$edad."<br>";
    echo "Estatura: ".$estatura.".<br>";
    echo "Email: ".$email."<br>";
    echo "Password: ".$password."<br>";
    echo "Confirmar contraseña: ".$passwordconfirm."<br>";
    $conexion->query("insert into users (name,last_name,age,wight,height,email,password)
    values ('$name','$apellido',$edad,$estatura,$peso,'$email','$password');") or die($conexion->error)

?>