<?php
if(isset($_GET['error'])){
    $error = $_GET['error'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Viajes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Log In</title>
    <link rel="stylesheet" href="./css/Loginstyles.css">
    <link rel="stylesheet" href="./css/mediaquery.css"> 
        
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h1 id="main-text">Hi There!</h1>
            <h2 id="subtext">Welcome to Routify</h2>
            <button id="google"> <img src="/css/img/GoogleIcon.png" alt="">Log in with Google</button>
            <h3 id="or"> ─────  Or  ───── </h3>
            <form action="./PDA/php/login.php" method="POST" id="loginForm" class="form-validate">
            <input type="text" name="txtEmail" id="email" placeholder="Your Email / Username" required>
            <input type="password" name="txtPassword" id="password" placeholder="Your Password" required>
            <a href="#" id="forgot-password">Forgot password?</a>
            <button type="submit" id="login-button" >Log In</button><!---->
            <p id="error-message" style="color: red;"></p>
            </form>
            <p>Don't have an account? <a href="./signup.php"> Sign Up</a></p>
        </div>
        <div class="image-section">
            <img id="side-image">
            <div class="image-text">Start planning your next getaway today.</div>
        </div>
    </div>
    <script src="./js/LandingPScripts.js"></script>
    <script src="./js/enter.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <?php 
    if(isset($error)){
    ?>
    <script>
        Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Credenciales incorrectas",
    });
    </script>
    <?php } ?>

</body>
</html>
