<?php
error_reporting(E_ALL);

while(true){
    fwrite(STDOUT, "$ ");
    $command = rtrim(fgets(STDIN), "\r\n");
    if($command === 'exit') break;
    fwrite(STDOUT, "{$command}: command not found\n");
}