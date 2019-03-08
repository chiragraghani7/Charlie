<?php
include_once("../includes/constants.php");
spl_autoload_register(function ($class_name){
include "../classes/".$class_name . '.class.php'; 
});

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db = new Database();
    $conn = $db->getConnection();
    $auth = new Authentication($conn);
    echo $auth->login($username, $password);
}

if(isset($_POST['logout'])){
   $db = new Database();
    $conn = $db->getConnection();
    $auth = new Authentication($conn);
    $auth->logout();
}

//
echo $_SESSION['SERVER_ADDR'];//if you are trying from studylinkclassses.com  then uski ip ayegi ni toh 1 aayega kyuki localhost h na self pe aayega
echo $_SESSION['HTTP_USER_AGENT'];//this returns the details of the user i.e which modzilla or firefox device name and alll
echo $_SESSION['REMOTE_ADDR'];//this returns my public ip 
?>