<?php

require_once("../include/initialize.php");



 ?>

<?php

 // login confirmation

  if(isset($_SESSION['USERID'])){

    redirect(web_root."admin/index.php");

  }

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="<?php echo web_root; ?>/img/windales.png">
    <title>Log in Now</title>
    <style>
    .signup {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form method="post" action="" role="login" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" name="user_email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="user_pass" id="password" placeholder="Password" />
                    </div>
                    <input type="submit" name="btnLogin" value="Login" class="btn solid" />
                    <!-- <p>Don't Have an Account?</p>
                    <a href="Signup.php" class="signup">Sign Up</a> -->
            </div>
        </div>
    </div>
    <?php 



if(isset($_POST['btnLogin'])){

  $email = trim($_POST['user_email']);

  $upass  = trim($_POST['user_pass']);

  $h_upass = sha1($upass);

  

   if ($email == '' OR $upass == '') {



      message("Invalid Username and Password!", "error");

      redirect("login.php");

         

    } else {  

  //it creates a new objects of member

    $user = new User();

    //make use of the static function, and we passed to parameters

    $res = $user::userAuthentication($email, $h_upass);

    if ($res==true) { 

       message("You login as ".$_SESSION['U_ROLE'].".","success");

      if ($_SESSION['U_ROLE']=='Administrator'){

         redirect(web_root."admin/index.php");

      }else{

           redirect(web_root."admin/login.php");

      }

    }else{

      message("Account does not exist! Please contact Administrator.", "error");

       redirect(web_root."admin/login.php"); 

    }

 }

 } 

 ?>

</body>

</html>