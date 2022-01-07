<?php

if($user->logout()){
    //echo "Successfully Log out<br/>";
    header("Location: login?msg=logout");
}
?>