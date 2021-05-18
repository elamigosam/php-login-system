<?php
// login page

/* Include the Account class file */
//require __DIR__.'/../functions.php';
//require __DIR__.'/../include/User.php';
//$user = new User();

// TRY TO LOGIN WITH PHP SESSIONS
if($login = $user->sessionLogin()){
  //redirect to home page
  header("Location: /home");
  die();
}

// PROCESS ANY MESSAGES FROM THE URL
if(isset($_GET['msg'])){
  if($_GET['msg'] == "logout"){
    $messages['danger'] = "Logout Successful";
  }
  if($_GET['msg'] == "register"){
    $messages['success'] = "You account was created successfully,<br/> check your email for an activation link to activate your account.";
  }
}

if(isset($_GET['activate'])){
  $messages = $_GET['activate']; 
}

// PROCESS THE LOGIN WITH USERNAME AND PASSSWORD
if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $pass = $_POST['password'];

  if(empty($email)){
    $messages['danger'] = "Please enter an email address";
  }elseif(empty($pass)){
    $messages['danger'] = "Please enter a Password";
  }else{
    $login = $user->login($email, $pass);
    if(isset($login['success'])){
      $messages = $login;
      //redirect to home page. 
      header("Location: /home");
    }
    else{
      $messages = $login;
    }
  }
}
?>

<?php 
// setup var for the header
$title = "Login";
include (__DIR__.'/../include/header.php'); 
?>

<div class="container">
<div class="row">
    <div class="col">
    </div>
    <div class="col text-center">
      <h3>Login</h3>
      <br/>
      <?php 
      if(isset($messages) && !empty($messages)){
        foreach ($messages as $key=>$message ){
          echo "<div class='alert alert-$key' role='alert'>".$message."</div>";         
        }
      }
  ?>
      
      <form method="POST" action="/login">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <br/>
        <button id="submit" name="submit" type="submit" class="btn btn-primary">Login</button>
        <br/>
        <hr />
        <a href="register" role="button" class="btn btn-link">Signup</a>
        
      </form>
    </div>
    <div class="col">
    </div>
</div>
</div> 

<?php include(__DIR__.'/../include/footer.php'); ?>