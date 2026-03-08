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
        $cmd = substr($command, 5);
        if(in_array($cmd, $commands)){
            fwrite(STDOUT, $cmd . " is a shell builtin\n");
            continue;
        } 
        foreach ( explode(':', $_SERVER['PATH']) as $path){
            if(file_exists($full_path = $path. DIRECTORY_SEPARATOR. $cmd) and is_executable($full_path)){
                fwrite(STDOUT, $cmd. " is ". $full_path . "\n");
                continue 2;
            }
        }
        fwrite(STDOUT, $cmd . ": not found\n");
    } else {
        fwrite(STDOUT, "{$command}: command not found\n");
    }
}