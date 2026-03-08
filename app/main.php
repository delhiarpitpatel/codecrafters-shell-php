<?php
error_reporting(E_ALL);

while(true){
    fwrite(STDOUT, "$ ");
    $command = rtrim(fgets(STDIN), "\r\n");
    if($command === 'exit') break;
    if(strpos($command,'echo') === 0){
        fwrite(STDOUT, str_replace('echo ', '', $command, 1));
    }
    fwrite(STDOUT, "{$command}: command not found\n");
}