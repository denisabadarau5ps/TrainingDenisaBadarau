<?php
include 'common.php';
session_start();
if(isset($_POST['login'])){
    $usernamelogin=testInput($_POST['username']);
    $passwordlogin=testInput($_POST['password']);

    if($usernamelogin == $adminUsername){
        if($passwordlogin == $adminPass){
            $_SESSION['username']=$usernamelogin;
            header('Location: products.php');
            exit;

        }else{
            echo  '<script>alert("Wrong password!")</script>';

        }
    }else{
        echo  '<script>alert("Wrong username!")</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Shopping Cart</title>
    <link rel="stylesheet" href="views/css/styles.css">
</head>
<body>
    <div class="loginContainer">
       <form action="login.php" method="post">
           <input type="text" name="username" placeholder="Username" required><br><br>
           <input type="password" name="password" placeholder="Password" required><br><br>
           <input type="submit" name="login" value="Login">
       </form>
    </div>
</body>
</html>
