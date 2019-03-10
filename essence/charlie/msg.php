<?php
require_once("db.php");
session_start();
$phone_number = $_POST["phone_number"];
$random_number = rand(1000,9999);
$_POST["random_number"] = $random_number;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?country=91&sender=CHARLIE&route=4&mobiles=".$phone_number."&authkey=242769ABa2cfCGg5bc34724&message=The otp is ".$random_number,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);



?>

