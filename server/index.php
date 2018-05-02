<?php

CONST _DEFAULT = "http://selfcdn.org/client/";
function findRequestRegion(){
    $region = json_decode(file_get_contents('https://ipinfo.io/'.$_SERVER['REMOTE_ADDR'].'/json'),true);
    return $region['country'];
}

function pickServer($region){
    $serve = $_GET['serve'];
    $servers = json_decode(file_get_contents('servers'),true);
    $host = "";
    
    if(!isset($servers[$region])){
        error_log('NO '.$region.' REGION');
        $host = _DEFAULT.$serve;
    }else{
        $host = $servers[$region][array_rand($servers[$region],1)].$serve;
    }

    if(checkFoundServerFileSum($host,$serve)){
        header('Location: '.$host);
        exit;
    }

    pickServer($region);

}

function checkFoundServerFileSum($host,$serve){
    $remote = md5(file_get_contents($host));
    $local = md5(file_get_contents(_DEFAULT.$serve));
    if(!$local === $remote){
        return false;
    }
    return true;
}

function startCdnRequest(){
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
    pickServer(findRequestRegion());
}

startCdnRequest();