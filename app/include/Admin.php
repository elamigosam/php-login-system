<?php
class Admin{

    
    
    public function getUsers(){ // GET THE LIST OF ALL USERS
        global $pdo;
        $q = "SELECT * FROM users"; 
        $stmt = $pdo->prepare($q);         
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            return $result;
        }else{
            //echo mysqli_error($link);
            die("Database Error g");
        }
        return false;
    }

    public function getUser($userId){ // GET THE INFO OF A SINGLE USER
        global $pdo;
        $q = "SELECT * FROM users WHERE id = :userId"; 
        $stmt = $pdo->prepare($q);         
        if($stmt->execute(['userId'=>$userId])){
            $result = $stmt->fetch();
            return $result;
        }else{
            //echo mysqli_error($link);
            die("Database Error g");
        }
        return false;
    }

    public function updateUser($userId, $fname, $lname, $username, $email, $mobile, $isActive, $isAdmin, $isUser){ // USED TO EDIT THE USER INFO FROM ADMIN PANEL, RETURNS TRUE OR FALSE
        /*
        $isActive, $isAdmin, $isUser = true or false values. 

        */
        $isActive = $isActive ? 1 : 0;
        $isAdmin = $isAdmin ? 1 : 0;
        $isUser = $isUser ? 1 : 0;

        global $pdo; //'fname' => $fname, 'lname'=>$lname, 'username'=>$username, 'email'=>$email, 'mobile'=>$mobile
        $q = "UPDATE users SET fname=:fname, lname=:lname, username=:username, email=:email, mobile=:mobile, isActive=:isActive, isAdmin=:isAdmin, isUser=:isUser WHERE id=:userId";
        $stmt = $pdo->prepare($q);
        if($stmt->execute(['userId'=> $userId, 'fname' => $fname, 'lname'=>$lname, 'username'=>$username, 'email'=>$email, 'mobile'=>$mobile, 'isActive'=>$isActive, 'isAdmin'=>$isAdmin, 'isUser'=>$isUser])){
            if ($stmt->rowCount()){
                return array('success'=>"Successfully Updated your info");
            } else{
                return array('danger'=>"No Changes Were Made");
            }
        }else{
            return array('danger'=>"Some other error happen");
            //echo mysqli_error($link);
            die("Database Error g");
        }
    }

    public function changeAccountStatus($userId){ // CHANGES THE isActive STATUS TO THE OPOSIVE, if it was in 1, changes to 0 
        global $pdo;
        $q = "UPDATE users SET `isActive` = NOT `isActive` WHERE id=:id";
        $stmt = $pdo->prepare($q);
        if($stmt->execute(['id'=>$userId])){
            // check the number of affected rows.
            if ($stmt->rowCount()){
                return true;
            } else{
                return false;
            }
        }
        else{
            return false;
            //echo mysqli_error($link);
            die("Database Error g");
        }


        return true;
    }

    public function getOptions($userId){
        global $pdo;
        $q = "SELECT * FROM options"; 
        $stmt = $pdo->prepare($q);         
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            return $result;
        }else{
            //echo mysqli_error($link);
            die("Database Error g");
        }
        return false;
    }




}
?>