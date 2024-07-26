<?php 
@include 'connect.php';
session_start();
if(!isset($_SESSION['user_name'])){
    header('location:login_form.php');
}
?>



<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>
    <!-- css file link -->
    <link rel="stylesheet" href="login.css">
</head>
   <body>
    <div class="page">
        <div class="container">
            <div class="content">
                    <h3>hi, <span>user</span></h3>
                    <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
                    <p>this is an user page</p>
                    <a href="add_task_admin.php" class="btn">To do list</a>
                    <a href="login_form.php" class="btn">login</a>
                    <a href="register.php" class="btn">register</a>
                    <a href="logout_page.php" class="btn">logout</a>
            </div>
        </div>
    </div>

   </body>
 </html>