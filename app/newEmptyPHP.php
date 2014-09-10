<?php


include_once("rcon.class.php");

// Extend the rcon class to tweak it for minecraft.
class minecraftRcon extends rcon {

function mcSendCommand($Command) {
$this->_Write(SERVERDATA_EXECCOMMAND,$Command,'');
}

function mcRconCommand($Command) {
$this->mcSendcommand($Command);

$ret = $this->Read();

return $ret[$this->_Id]['S1'];
}
}

// Server connection varialbes
$server = "ms4.hicoria.com";
$rconPort = 28074;
$rconPass = "snoop";

// Connect to the server
$r = new minecraftRcon($server, $rconPort, $rconPass);

var_dump($r->mcRconCommand('say Hello World!'));

echo "Authenticated\n";
