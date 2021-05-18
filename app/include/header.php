<?php
// REDIRECT TO LOGIN IS USER IS NOT LOGEDIN. 
if(!isset($title)){
  //redirect to home page
  header("Location: ../login.php");
  die();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    

    <title><?php echo isset($title) ? $title : "PHP Login System" ?></title>

  </head>
  <body>
  <?php
  if(isset($auth)){
      if($auth == true){
          //echo "Internal Nav Bar"; ?>

          <?php
      }
  }else{
      //echo "External Nav Bar";
  }
  ?>