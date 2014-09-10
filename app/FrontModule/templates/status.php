<?php

$ip = 'ms4.hicoria.com';
$port = 28075;

$checkSock = @fsockopen($ip, $port, $empty, $empty, 1);

if($checkSock !== FALSE)
{
    echo  'Online';
}else{
    echo  'Offline';
}

?>