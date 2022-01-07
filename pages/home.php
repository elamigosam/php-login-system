<?php

// GET THE USER INFO 
$userInfo = $user->getUserInfoById();
if(!$userInfo){
  //failed to get the user info, so user is loged out.
  header("Location: /logout");
  die();
}

//$debug = $userInfo;

$title = "Home | PHP Login System"; // SETUP THE TITLE VAR FOR THE title tag
include ($directory.'/include/header.php');
include ($directory.'/include/nav.php');
?>


<div class="container">
<h2>Home Page</h2>
</div>




<?php
// FOOTER 
include($directory.'/include/footer.php'); 
?>