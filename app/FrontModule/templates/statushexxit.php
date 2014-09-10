<?php

$ip = 'ms3.hicoria.com';
$port = 25210;

$checkSock = @fsockopen($ip, $port, $empty, $empty, 1);

if($checkSock !== FALSE)
{
    echo  'Online';
}else{
    echo  'Offline';
}

?>