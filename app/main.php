<?php
error_reporting(E_ALL);

while(true){
    fwrite(STDOUT, "$ ");
    $command = rtrim(fgets(STDIN), "\r\n");
    if($command === 'exit') break;
    if(str_starts_with($command, 'echo ')){
        fwrite(STDOUT, substr($command, 5) . "\n");
        continue;
    }
    fwrite(STDOUT, "{$command}: command not found\n");
}