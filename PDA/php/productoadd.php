<?php
include "./conexion.php";
    $name = $_POST['txtNamee'];
    $desc= $_POST['txtDesc'];
    $price = $_POST['txtPrice'];
    $duracion = $_POST['txtDuracion'];

    $filename = $_FILES['txtImg']['name'];
    $temp = explode(".",$filename);
    $ext = end($temp);
    echo $filename;
    $destino="../img/travels/";
    $newname=date('Y_m_d_h_i_s').rand(1000,9999).".".$ext;

    if(move_uploaded_file($_FILES['txtImg']['tmp_name'],$destino.$newname)){
        echo "Archivo subido correctamente\n";
        $con ="INSERT INTO paquete_viaje VALUES (0,'$name', '$desc', '$price', '$duracion','$newname')";
        echo $con;
        $conexion -> query($con) or die($conexion -> error);
        echo "\n Registro insertado correctamente";
    } else{
        echo "No se pudo subir correctamente";  
    }
    
    header("Location: ../payment.php?status=1");
?>