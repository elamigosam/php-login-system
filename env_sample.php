<?php
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$WebsiteName = "PHP Login System";

$host = 'mariadb';
$user = 'myuser';
$passwd = 'mypassword';
$dbname = 'mydatabase';

//SMTP Email settings:
$enableSmtp = false;
$smtpHost = "smtp.gmail.com";
$smtpUsername = "username@gmail.com";
$smtpPassword = 'Password123'; 
$smtpPort = 587; 
$smtpFrom = "username@gmail.com";
$smtpFromName = "Php Login System Website";