<?php
error_reporting(E_ALL);

$commands = [
    'echo', 'type', 'exit'
];
while(true){
    fwrite(STDOUT, "$ ");
    $command = rtrim(fgets(STDIN), "\r\n");
    if($command === 'exit') break;
    if(str_starts_with($command, 'echo ')){
        $arg = substr($command, 5);
        fwrite(STDOUT, $arg . "\n");
    } else if( str_starts_with($command, 'type ')){
        $arg = substr($command, 5);
        if(in_array($arg, $commands)){
            fwrite(STDOUT, $arg . " is a shell builtin\n");
        } else{
            fwrite(STDOUT, $arg . ": not found\n");
        }
    } else {
        fwrite(STDOUT, "{$command}: command not found\n");
    }
}