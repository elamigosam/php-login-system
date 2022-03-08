<?php
// login page

// SETUP THE VARIABLES 
$msgs = array(); // variable to store the messages requred by msgs()




// PROCESS ANY MESSAGES FROM THE URL
if(isset($_GET['msg'])){
  if($_GET['msg'] == "logout"){
    $msgs[] = array('danger'=>"Logout Successful");
  }
  if($_GET['msg'] == "register"){
    $msgs[] = array('success'=>"You account was created successfully,<br/> check your email for an activation link to activate your account.");
  }
}

// TRY TO LOGIN WITH PHP SESSIONS
if($login = $user->sessionLogin()){
  //redirect to home page
  header("Location: /home");
  die();
}

if(isset($_GET['activate'])){
  //$messages = $_GET['activate'];
  $msgs[] = array('info'=>$_GET['activate']);
}

// PROCESS THE LOGIN WITH USERNAME AND PASSSWORD
if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $pass = $_POST['password'];

  if(empty($email)){
    $msgs[] = array('danger'=>"Please enter an email address");
  }elseif(empty($pass)){
    $msgs[] = array('danger'=>"Please enter a Password");
  }else{
    $login = $user->login($email, $pass);
    if(isset($login['success'])){
      //$msgs[] = $login;
      //redirect to home page. 
      header("Location: /home");
    }else{
      $msgs[] = $login;      
    }
  }
}


// setup var for the header
$title = "Login | ".$WebsiteName;
include (__DIR__.'/../include/header.php'); 
?>

<div class="container">
  <div class="row justify-content-center my-5">
  <?php msgs($msgs) ?>
    <div class="col-lg-4 col-sm-12 col-md-6 text-center">
      <h3>Login</h3>
      <br/>

      <?php /* old code replaced by function 
      if(isset($messages) && !empty($messages)){
        foreach ($messages as $key=>$message ){
          echo "<div class='alert alert-$key' role='alert'>".$message."</div>";         
        }
      } */
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
</div>
</div> 

<?php include(__DIR__.'/../include/footer.php'); ?>