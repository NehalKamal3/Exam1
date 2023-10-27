<?php  
session_start();

$_SESSION['username'];
$_SESSION['pass'];
$_SESSION['email'];
echo $_SESSION['user-type'];
//$_SESSION['img'] = $url.$name;

$errors=[] ; $uerror = []; $emailerror=''; $passerror=[];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login'])){
             
            $name =$_POST['name'];
            $email=$_POST['name'];
            $pass=$_POST['password'];
if(($_SESSION['username'] == $name  || $_SESSION['email'] == $email ) && $_SESSION['pass'] == $pass  ){
    if($_SESSION['user-type'] == 'admin'){
        header("location:dashboard/index.php");
    }if($_SESSION['user-type'] == 'user'){
        header("location:front/index.php");
    
    
    }
}else{
    $errors[]='data is not correct !';
}

if(empty(($name && $email) || $pass )){
    $errors[]= 'please fill all the data';
}


if(strlen(trim($name)) <5 || strlen(trim($name)) >20 ){
    $uerror[] ='username lenght from 5 to 20';
}if(!preg_match( "^[a-zA-Z0-9_]*$" ,trim($name) )){
    $uerror[]='username must only contains alphanumeric characters and underscores ';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 
    $emailerror = "email is not a valid email address";

}
if(strlen(trim($pass)) < 8){
    $passerror[]= "Password must be at least 8 characters long.";
  }if(!preg_match( "^[a-zA-Z0-9_]*$" ,trim($pass) )){
     $passerror[]='password must only contains alphanumeric characters and underscores ';
 }


    }}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,
                    #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            height: fit-content;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post">
        <h3>Login Here</h3>
        <?php  if(isset($errors) && !empty($errors)):
        foreach($errors as $error):
           echo " <div class='alert alert-danger' role='alert'>
  $error
</div>";
        endforeach;
    endif;
    ?>
        <label for="username">Username Or Email</label>
        <input type="text" placeholder="Email or Username" name ="name" id="username">
        <?php 
   if(isset($uerror) && !empty($uerror)  ): 
    foreach($uerror as $user):
        echo "<div class='alert alert-danger' role='alert'>$user</div>";
    endforeach;
  endif;
   if(isset($emailerror) && !empty($emailerror)  ): 
    echo "<div class='alert alert-danger' role='alert'>$emailerror</div>";
  endif;
    ?>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" id="password">
        <?php if(isset($passerror) && !empty($passerror)  ):
             foreach($passerror as $passer):
                echo "<div class='alert alert-danger' role='alert'>$passer</div>";
             endforeach;
                  endif;
 ?>  
        <button type="submit" name="login" class="btn btn-primary">Log In</button>
        <div class="social">
            <div class="go"><i class="fab fa-google"></i> <a href="register.php">Register</a> </div>
        </div>
    </form>
</body>

</html>