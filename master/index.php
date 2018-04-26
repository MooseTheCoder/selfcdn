<?php
//root config
$default = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

if(!isset($_GET['serve']) || $_GET['serve'] == ""){
    echo "Nothing to serve";
    exit;
}

$region = json_decode(file_get_contents('https://ipinfo.io/'.$_SERVER['REMOTE_ADDR'].'/json'));

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
exit;
header('Location: '.$host.$serve);

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