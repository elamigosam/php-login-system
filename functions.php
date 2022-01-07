<?php


if (file_exists($directory.'/env.php')) {
  require($directory.'/env.php');
}else{
  die("Failed to find env file");
}

//SET required variables
date_default_timezone_set('UTC');

// SETUP PDO CONNECTION INSTANCE
 // Set DSN
 $dsn = 'mysql:host='. $host .';dbname='. $dbname;

 /////////// Create a PDO instance ///////////
 $pdo = new PDO($dsn, $user, $passwd);
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);



/////////// Create a MYSQLI instance ///////////
$links = mysqli_connect($host, $user, $passwd, $dbname);
// Check connection
if (!$links) {
  die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_set_charset($links, "utf8")) {
  printf("Error loading character set utf8: %s\n", mysqli_error($link));
  die();
}



/*
Used to send sql queries to sql server through pdo. 
->accepts:
$query: the actual text query
$placeholders: array of placeholders for pdo
->returns:
$data = array()
On failed: 
 $data['error'] // contains the error details. 
On success: 
 $data['result'] // contains the result array
 $data['count'] // contains the total count
*/
function sql_query($query, $placeholders = false){
  $data = array();
  
  global $pdo;
  $letter = substr($query, 0, 1);
  
  try{
    $stmt = $pdo->prepare($query);
    //echo "Successfully Prepared<br/>";
  }
  catch(PDOException $e){
    $data['error'] = "Prepare Failed: ".$e->getMessage();
    return $data;
  }
  
  if(!$stmt){
    $data['error'] = "Query Failed";
    return $data;
  }
  
  try{
    if($placeholders){
      $stmt->execute($placeholders);
    }
    else{
      $stmt->execute();
    }
    
    $data['count'] = $stmt->rowCount();
    
    if($letter === "S"){
      if($data['count'] > 1){
        $data['result'] = $stmt->fetchAll();
      }else{
        $data['result'][] = $stmt->fetch();
      }
    }
    
  }
  catch(PDOException $e){
    $data['error'] = 'Connection failed: ' . $e->getMessage();
  }  
  return $data;
}




function smtpMail($to, $subject, $message){
  global $enableSmtp;
  global $url;
  global $smtpHost;
  global $smtpUsername;
  global $smtpPassword;
  global $smtpPort;
  global $smtpFrom;
  global $smtpFromName;

  if($enableSmtp){

    //require (__DIR__.'/include/phpMailer/Exception.php');
    require (__DIR__.'/include/phpMailer/SMTP.php');
    require (__DIR__.'/include/phpMailer/PHPMailer.php');

    $mail = new PHPMailer(true);
    $mail->setLanguage("en");
    $mail->SMTPDebug = 0;     
    $mail->isSMTP();   
    $mail->Host = $smtpHost; 
    $mail->SMTPAuth = true;                          
    $mail->Username = $smtpUsername;                  
    $mail->Password = $smtpPassword;                           
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtpPort;                                   

    $mail->From = $smtpFrom; 
    $mail->FromName = $smtpFromName; 

    $mail->addAddress($to); 
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    //$mail->AltBody = "This is the plain text version of the email content";

    $SentEmail = false;
    try {
        $mail->send();
        $SentEmail = true;
        //echo "Send Succesfull";
        return array('success'=>"Succesfully send your Email");
    } 
    catch (Exception $e) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        $SentEmail = false;
        return array('danger' => "Failed to send email");
    }
  }
  else{
    return array('danger'=>"SMTP Is not Enabled");
  }
}

?>
