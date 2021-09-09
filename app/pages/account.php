<?php

// GET THE USER INFO 
if(!$userInfo = $user->getUserInfoById()){
    //failed to get the user info, so user is loged out.
    header("Location: /logout");
    die();
}


//  PROCESS the update info 
if(isset($_POST['update-info'])){
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $fname = filter_var(trim($_POST['fname']), FILTER_SANITIZE_STRING);
    $lname = filter_var(trim($_POST['lname']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mobile = filter_var(trim($_POST['mobilePhone']), FILTER_SANITIZE_STRING);
    if(empty($username)){
        $msg['danger'] = "Username Must Not be Empty";
    }elseif(empty($fname)){
        $msg['danger'] = "First Name Must Not be Empty";
    }elseif(empty($lname)){
        $msg['danger'] = "Last Name Must Not be Empty";
    }elseif(empty($email)){
        $msg['danger'] = "Email Must Not be Empty";
    }else{
        // continue after the checks.
        $msg = $user->editAccountInfo($username, $fname, $lname, $email, $mobile);     
	} 
}

//Process the Password Update
if(isset($_POST['update-password'])){
	if($_POST['new-pass'] === $_POST['verify-pass']){
		//print_r($_POST);
		$newPass = $_POST['new-pass'];
		if(!empty($oldPass) || !empty($newPass)){
			$msg = $user->editAccountPassword($newPass);
		} 
	}
	else{
		$msg['danger'] = "Passwords Do Not Match!";
	}
}


// GET THE USER INFO TO POPULATE THE FORM
if(!$getUinfo = $user->getUserInfoById()){
    //failed to get the user info, so user is loged out.
    header("Location: /logout");
    die();
}


?>




<?php
// INCLUDE THE HEADER TO INCLUDE THE NAV AND MENUS.
$title = "Account | PHP Login System"; // SETUP THE TITLE VAR FOR THE title tag
include (__DIR__.'/../include/header.php');
include(__DIR__.'/../include/nav.php');
?>





<div class="container">
<?php 
      if(isset($msg) && !empty($msg)){
        foreach ($msg as $key=>$message ){
          echo "<div class='alert alert-$key' role='alert'>".$message."</div>";         
        }
      }
  ?>
  <div class="row">
    <h3>Update your Info</h3>
	<div class="col">
	  <form action="/account" method="post">

		<div class="form-group">
			<label for="inputUsername">Username</label>
			<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" value="<?php echo $getUinfo['username']; ?>">
		</div>
		
		<div class="form-group ">
			<label for="inputFirstName">First name</label>
			<input type="text" class="form-control" id="inputFirstName" placeholder="First name" name="fname" value="<?php echo $getUinfo['fname']; ?>">
		</div>
		<div class="form-group ">
			<label for="inputLastName">Last name</label>
			<input type="text" class="form-control" id="inputLastName" placeholder="Last name" name="lname" value="<?php echo $getUinfo['lname']; ?>">
		</div>

		<div class="form-group">
			<label for="inputEmail4">Email</label>
			<input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="<?php echo $getUinfo['email']; ?>">
		</div>

		<div class="form-group">
			<label for="inputMobile">Mobile Phone Number</label>
			<input type="phone" class="form-control" id="inputMobile" placeholder="Mobile Phone Number" name="mobilePhone" value="<?php echo $getUinfo['mobile']; ?>">
		</div>

		<br/>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="update-info">Update Information</button>
		</div>
			</form>
		</div>
	</div>


<hr/>

  <div class="row">
	  <h3>Update Your Password</h3>
		<div class="col">
			<form action="/account" method="post">
				<div class="form-group">
					<label for="inputPasswordNew">New password</label>
					<input type="password" class="form-control" name="new-pass" id="inputPasswordNew">
				</div>
				<div class="form-group">
					<label for="inputPasswordNew2">Verify password</label>
					<input type="password" class="form-control" name="verify-pass" id="inputPasswordNew2">
				</div>
				<br/>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="update-password">Update Password</button>
				</div>
			</form>
		</div>
	</div>
</div>
<hr/>

<?php
// FOOTER 
include(__DIR__.'/../include/footer.php'); 
?>