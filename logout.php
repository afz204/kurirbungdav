<?php
require_once('config/session.php');
require_once('config/api.php');
$user_logout = new Login();

if($user_logout->is_loggedin() != ""){
    $user_logout->doLogout();
    $user_logout->redirect('login');
}
//
//if($user_logout->is_loggedin()!="")
//{
//    $user_logout->redirect('login.php');
//}
//if(isset($_GET['logout']) && $_GET['logout']=="true")
//{
//    $user_logout->doLogout();
//    $user_logout->redirect('login.php');
//}
