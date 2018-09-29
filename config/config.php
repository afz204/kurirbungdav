<?php
/**
 * Created by PhpStorm.
 * User: small-project
 * Date: 01/04/2018
 * Time: 13.10
 */
require 'session.php';
define('URL', 'http://kurir.bungadavi.co.id/');
define('URL_SERVER', 'http://kurir.bungadavi.co.id/');


$config = new Admin();

if(isset($_SESSION['user_session']) && $_SESSION['user_session']['usertype'] == 'kurir')
{
    $session_id = $_SESSION['user_session'];
}else{
    echo 'error';
}
//read url
$url = "$_SERVER[REQUEST_URI]";
$url = explode('/', $url);

$menu = $url[2]; //menu
if(empty($menu)){
    $menu = 'index';
}else{
    $menu = $menu;
}   
if (isset($url[3])){
    $root = explode('&', $url[3]);
    if($root == true){
        $root = explode('=', $root[0]);
        if(isset($root[1])){
            $footer = $root[1];
        }else{
            $footer = '';
        }
    }else{
        $footer = $url[1];
    }
}else{
    $footer = "";
}

require 'model.php';
$device = $config->systemInfo();

$datakurir = $config->getKurir($_SESSION['user_session']['userid']);
// echo '<pre>';
// print_r($datakurir);
// echo '</pre>';