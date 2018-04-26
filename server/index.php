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

$default = "http://selfcdn.org/client/";

if(!isset($_GET['serve']) || $_GET['serve'] == ""){
    //Get list of things to serve
    $canServe = array_diff(scandir('client'),['..','.']);
    $e="<h1>Nothing to serve, but here is what we have!</h1><br />";
    foreach($canServe as $serve){
        $e.=$serve . "| http://selfcdn.org/?serve=".$serve." <br />";
    }
    echo $e;
    exit;
}

$region = json_decode(file_get_contents('https://ipinfo.io/'.$_SERVER['REMOTE_ADDR'].'/json'),true);

$region = $region['country'];

$serve = $_GET['serve'];

$servers = json_decode(file_get_contents('servers'),true);

$host = "";

if(!isset($servers[$region])){
    error_log('NO '.$region.' REGION');
    $host = $default.$serve;
}else{
    $host = $servers[$region][array_rand($servers[$region],1)].$serve;
}

header('Location: '.$host);