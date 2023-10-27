<?php 
session_start();

$allowed_ext = ['png' , 'jpg' , 'jpeg','webp'];
$errors=[] ; $uerror = []; $emailerror=''; $passerror=[];$imgerror = [] ; $conferror='';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['register'])){

            $name =$_POST['username'];
            $email=$_POST['email'];
            $pass=$_POST['pass'];
            $conf_pass=$_POST['conf-pass'];
           $user_type=$_POST['users'];

            $_SESSION['username']=$name;
            $_SESSION['pass']=$pass;
            $_SESSION['email']=$email;
            $_SESSION['user-type']=$user_type;

            if(isset($_FILES['image'])){

                $img=$_FILES['image'];
                $tmp = $_FILES['image']['tmp_name'] ;
                $url = 'uploads/profile/'  ;
                $name = uniqid() . $_FILES['image']['name'];
              
                $imgsize = $img['size'] ;
                $imgext = explode('.', $name);
                $imgend= end($imgext);
                $ext = strtolower($imgend);

                if($imgsize <1572864){
                    if(in_array($ext , $allowed_ext)){

                        move_uploaded_file($tmp ,$url.$name);

                      //  $_SESSION['img'] = $url.$name;
                    }else{
                        $imgerror []="image must be of type $allowed_ext";
                    }
                }else{
                    $imgerror[]="too large file max allowed is 1.5 mega";
                }
            }else{
                $imgerror[]='please choose file';
            }

            if(isset($_POST['register']) && empty($name || $email || $pass || $conf_pass ||$user_type)){
                $errors[]= 'please fill all the data';
            }

            if(strlen(trim($name)) <5 || strlen(trim($name)) >20 ){
                $uerror[] ='username lenght from 5 to 20';
            }if(!preg_match( "^[a-zA-Z0-9_]*$" ,trim($name) )){
              $uerror[]='username only contains alphanumeric characters and underscores ';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             
                $emailerror = "email is not a valid email address";

    }
    

    if(!empty($_FILES['image']['name'])) {
    }else{
        $_SESSION['img']=$url.$name;
     }
     if(strlen(trim($pass)) < 8){
       $passerror[]= "Password must be at least 8 characters long.";
     }if(!preg_match( "^[a-zA-Z0-9_]*$" ,trim($pass) )){
        $passerror[]='password must only contains alphanumeric characters and underscores ';
    }
if(trim($conf_pass ) != trim($pass)){
    $conferror ='passwords must be identical';
}
if(empty($errors && $uerror && $imgerror && $emailerror && $passerror && $conferror  ) ){
    
    header('location:login.php');
      //  die; ))
     }  



   }
    }





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
            top: 40%;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -65%;
        }

        form {
            margin-top: 300px;
            margin-bottom: 300px;
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

        input[type=radio] {
            height: 25px;
            width: 25px;
            display: inline-block;
        }

        .spn-radio {
            padding: 5px;
            font-size: 20px;
            color: #EB901A;
        }
    </style>

</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form  action=""  method="post" enctype="multipart/form-data">
        <h3>Register Here</h3>
        <?php  if(isset($errors) && !empty($errors)):
        foreach($errors as $error):
           echo " <div class='alert alert-danger' role='alert'>
  $error
</div>";
        endforeach;
    endif;
    ?>

        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" viewBox="0 0 16 16">
                <path
                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>

        <label for="username">Username</label>
        <input type="text" placeholder="username" name ="username"id="username">
        <?php 
   if(isset($uerror) && !empty($uerror)  ): 
    foreach($uerror as $user):
        echo "<div class='alert alert-danger' role='alert'>$user</div>";
    endforeach;
  endif;
        ?>

        <label for="email">Email</label>
        <input type="text" placeholder="email"  name="email"  id="email">
        <?php  if(isset($emailerror) && !empty($emailerror)  ): 
        echo "<div class='alert alert-danger' role='alert'>$emailerror</div>";
      endif;
        ?>

        <label for="img">Profile Image</label>
        <input type="file"  name="image" id="img">
        <?php if(isset($imgerror) && !empty($imgerror)  ):
             foreach($imgerror as $img):
                echo "<div class='alert alert-danger' role='alert'>$img</div>";
             endforeach;
                  endif;
 ?>  

        <label for="username">User Type</label>
      <!--  <input type="radio" id="1" name="users" value="admin"><span class="spn-radio">Admin</span>
        <input type="radio" id="2" name="users " value="user"><span class="spn-radio">User</span>-->
        <label for="">admin</label>

        <input type="radio" id="html" name="users" value="admin">
        <label for="">user</label>

  <input type="radio" id="css" name="users" value="user">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="pass" id="password">
        <?php if(isset($passerror) && !empty($passerror)  ):
             foreach($passerror as $passer):
                echo "<div class='alert alert-danger' role='alert'>$passer</div>";
             endforeach;
                  endif;
 ?>  

        <label for="co-password">confirm Password</label>
        <input type="password" placeholder="Confirm Password" name="conf-pass"id="co-password">
        <?php if(isset($conferror) && !empty($conferror)  ):
           
                echo "<div class='alert alert-danger' role='alert'>$conferror</div>";
                  endif;
 ?>  
              <button type="submit" name="register" class="btn btn-primary">sign up</button>

        <div class="social">
            <div class="go">

            <i class="fab fa-google "></i> <a href="login.php">log in</a>  </div>
        </div>
    </form>
</body>

</html>