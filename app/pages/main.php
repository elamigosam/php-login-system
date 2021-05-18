<?php
// INCLUDE THE HEADER TO INCLUDE THE NAV AND MENUS.
$title = "Page Not Found"; // SETUP THE TITLE VAR FOR THE title tag
include (__DIR__.'/../include/header.php');
//include(__DIR__.'/../include/nav.php');
?>
<div class="container">
  <div class="row m-4">
    <div class="col text-center">
      <h1>PHP Login System</h1>
    </div>
  </div>

  <div class="row m-4">
    <div class="col text-center">
    <a href="/login">Login</a>
    </div>
  </div>

</div>


<?php
// FOOTER 
include(__DIR__.'/../include/footer.php'); 
?>