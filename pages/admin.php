<?php
/*
This page comes from index.php
we need to make sure user is authenticated else redirect to home. 
*/
if(!$user->isAdmin() && !$auth){
    //header("Location: home");
    die("Redirect Home from Admin");
}

// GET THE USER INFO 
$userInfo = $user->getUserInfoById();
if(!$userInfo){
  //failed to get the user info, so user is loged out.
  header("Location: logout.php");
  die();
}

// DECLARE THE ADMIN CLASS
require $directory.'/include/Admin.php';
$admin = new Admin();

// PROCESS RECEIVED MESSAGES TO DISPLAY
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
}



// INCLUDE THE HEADER TO INCLUDE THE NAV AND MENUS.
$title = "Admin | ".$WebsiteName; // SETUP THE TITLE VAR FOR THE title tag
include ($directory.'/include/header.php');
include ($directory.'/include/nav.php');




// CHECK FOR SUB PAGE: /admin/thisone/somethingelse
if(isset($url_path['1'])){
    $subPage = filter_var($url_path['1'], FILTER_SANITIZE_STRING);
    // find the page on the pages directory
    
    if(file_exists($directory."/pages/admin/".$subPage.".php")){
        require_once $directory."/pages/admin/".$subPage.".php";
    }else{
        // Bad URL Page      
        echo "Page Not Found";  
    }
}else{
    // DISPLAY THE REGULAR PAGE
    echo "Main Admin Page";
}

  

// FOOTER 
include($directory.'/include/footer.php'); 



/*
// CHECK FOR SUB PAGE: /admin/something/thisone
if(isset($url_path['2'])){

}
*/

?>