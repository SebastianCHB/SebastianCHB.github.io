<?php session_start();
include("./conexion.php");
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    echo "Bienvenido $email Password: $password";
    echo '<br>';
    $query = "select * from users where email = '$email' and password = '$password';";

    $res = $conexion -> query($query);
    if(mysqli_num_rows($res)>0){
        echo "Login correcto".'<br>';
        $fila = mysqli_fetch_row($res);
        echo "Id: ".$fila[0].'<br>';
        echo "Nombre: ".$fila[1].'<br>';
        echo "Rol: ".$fila[2].'<br>';
        $arr=[
            'id'=>$fila[0],
            'name'=>$fila[1],
            'rol'=>$fila[2],
        ];
        $_SESSION['userdata']=$arr;

        if($fila[2] == 1){
            header("Location: ../index.php");
        }else{
          header("Location: ../../index.html");
        }
    }else{
        echo"Datos no validos";
        header("Location: ../../login.php?error=datos no validos
        
         ");
    }
    ?> 