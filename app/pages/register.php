



<?php


/// used to register users
/// also used to activate accounts, when the user clicks on the registration code to activate the account
// PROCESS THE ACCOUNT ACTIVATION 
if(isset($_GET['code']) && isset($_GET['email'])){
  $code = filter_var($_GET['code'], FILTER_SANITIZE_STRING);
  $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
  
  if(!empty($email) && !empty($code)){
    // activate the account with the code
    $verify = $user->verifyAccount($email, $code);
    if(isset($verify['success'])){
      $messages['success'] = "Your Account was Successfully Activated!";
    }if(isset($verify['error'])){
      $messages['success'] = "There was an error activating your account";
    }
  }       
}

// fname, lname, username, email, password
// PROCESS THE REGISTRATION
if(isset($_POST['submit']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){

    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['password'];
    $confPass = $_POST['confirm-password'];


    if($pass != $confPass){
      $messages['danger'] = "Password is not the Same";
    }elseif(empty($fname)){
        $messages['danger'] = "Empty First Name";
    }elseif(empty($lname)){
        $messages['danger'] = "Empty Last Name";
    }elseif(empty($username)){
        $messages['danger'] = "Empty Username";
    }elseif(empty($email)){
        $messages['danger'] = "Empty Email";
    }elseif(empty($pass)){
        $messages['danger'] = "Empty Password";
    }else{

        // CONTINUE WITH REGISTRATION
        $messages = $user->addAccount($fname, $lname, $username, $email, $pass);
        if(isset($messages['success'])){
            //redirect to login with successfull message.

        }
    }

  }
  ?>
  
  <?php 
  // setup var for the header
  $title = "Register | PHP Login System";
  include ($directory.'/include/header.php');
  ?>
  
  <div class="container">
  <div class="row">
      <div class="col">
      </div>
      <div class="col text-center">
        <h3>Register</h3>
        <br/>
        <?php 
        if(isset($messages) && !empty($messages)){
          foreach ($messages as $key=>$message ){
            echo "<div class='alert alert-$key' role='alert'>".$message."</div>";         
          }
        }
    ?>
        
        <form method="POST" action="register">
          <div class="form-group">
            <label for="fname">First Name</label>
            <input type="fname" class="form-control" name="fname" id="fname" placeholder="First Name">
          </div>
          <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="lname" class="form-control" name="lname" id="lname" placeholder="Last Name">
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="username" class="form-control" name="username" id="username" placeholder="Username">
          </div>

          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          </div>

          <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
          </div>

          <br/>
          <button id="submit" name="submit" type="submit" class="btn btn-primary">Register</button>
          <a name="login" class="btn btn-primary" href="login">Back to Login</a>
          <br/>
          <hr />
          
        </form>
      </div>
      <div class="col">
      </div>
  </div>
  </div> 
  
  <?php include($directory.'/include/footer.php'); ?>