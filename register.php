<?php
@include 'connect.php';
if(isset($_POST['submit'])){
    $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $number = intval($_POST['number']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $gender = $_POST['gender'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result)>0){
        $error[] = 'user already exist!';
    }else{
        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO user_form(firstName,lastName,email,number,password,gender) VALUES('$firstName','$lastName','$email',
            '$number','$pass','$gender')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');


        }
    }
};
?>

<html>
    <head>
        <title>Registration page</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body class="reg">
      <section class="register">
            <div class="container">
                <div class="title">Registration</div>
                <form method="post" action="register.php">
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        };
                    };
                    ?>
                    <div class="user-details">
                        <div class="input-box">
                            <label for="firstName" class="details">Fisrt Name</label>
                            <input type="text" placeholder="Enter your name" id="firstName" name="firstName" required>
                        </div>
                        <div class="input-box">
                            <label for="lastName" class="details">Last Name</label>
                            <input type="text" placeholder="Enter your username" id="lastName" name="lastName" required>
                        </div>
                        <div class="input-box">
                            <label for="email" class="details">Email</label>
                            <input type="email" placeholder="Enter your email" id="email" name="email" required>
                        </div>
                        <div class="input-box">
                            <label for="number" class="details">Phone Number</label>
                            <input type="number" placeholder="Enter your number" id="number" name="number" required>
                        </div>
                        <div class="input-box">
                            <label for="password" class="details">Password</label>
                            <input type="password" placeholder="Enter your password" id="password" name="password" required>
                        </div>
                        <div class="input-box">
                            <label for="cpassword" class="details">Confirm Password</label>
                            <input type="password" placeholder="Confirm your password" id="cpassword" name="cpassword" required>
                        </div>
                    </div>
                    <div class="gender-details">
                        <input type="radio" name="gender" id="dot-1" value="male">
                        <input type="radio" name="gender" id="dot-2" value="female">
                        <input type="radio" name="gender" id="dot-3" value="other">
                        <span class="gender-title">Gender</span>
                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span class="gender">male</span>
                            </label>
                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span class="gender">female</span>
                            </label>
                            <label for="dot-3">
                                <span class="dot three"></span>
                                <span class="gender">perfer not to say</span>
                            </label>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="Register">
                    </div>
                    <p>already have an account ? <a href="login_form.php">login now</a>
                </form>
            </div>
        </section>
    </body>
</html>

