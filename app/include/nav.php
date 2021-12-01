<?php
// REDIRECT IF THE NAV IS LOADED WITHOUT A TITLE
if(!isset($title)){
  //redirect to main page
  header("Location: /");
  die();
} ?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  
    <a class="navbar-brand" href="/home">Home</a>
    
    <?php // mobile menu icon ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <?php if($auth){ 
      // guest visitor menu options 
      ?>




    <?php if(isset($user)){ 
      // authenticated user visitor menu options
      ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>

        

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>

          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Option 2</a></li>
            
            <li><a class="dropdown-item" href="#">Option 1</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Another Option</a></li>
          </ul>
        </li>

          

            <?php 
          if($user->isAdmin()){ // display admin menu option ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/admin/users">Users</a></li>
              <li><a class="dropdown-item" href="/admin/options">Options</a></li>
              <li><a class="dropdown-item" href="/admin/pages">Pages</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <?php } ?>
          
       
      </ul>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mda.png" width="32" height="32" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood">
          <span class="text-white"><?php echo $userInfo['fname']." ".$userInfo['lname'] ?></span>
        
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="/profile">Profile</a></li>
          <li><a class="dropdown-item" href="/account">Account</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="/logout">Logout</a></li>
        </ul>
      </li>
      
				

  </div>

  <?php } ?>

  <?php } ?>
</nav>

