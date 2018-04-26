<?php
//root config
/*
    ['US'=>[
        'server',
        'server',
        'server',
        'server',
    ],'UK'=>[
        'server',
        'server',
        'server',
        'server',
    ]];
*/

$default = "http://cdn.selfcdn.org/";

if(!isset($_GET['serve']) || $_GET['serve'] == ""){
    echo "Nothing to serve";
    exit;
}

$region = json_decode(file_get_contents('https://ipinfo.io/'.$_SERVER['REMOTE_ADDR'].'/json'),true);

$region = $region['country'];

$serve = $_GET['serve'];

$servers = json_decode(file_get_contents('servers'),true);

$host = "";

if(!isset($servers[$region])){
    $host = $default.$serve;
}else{
    $host = $servers[$region][array_rand($servers[$region],1)];
}
echo $host;

header('Location: '.$host.$serve);