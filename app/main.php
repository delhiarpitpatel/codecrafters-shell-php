<?php
error_reporting(E_ALL);

$commands = [
    'echo', 'type', 'exit'
];
function get_executable_path($cmd){
    foreach ( explode(':', $_SERVER['PATH']) as $path){
        if(file_exists($full_path = $path. DIRECTORY_SEPARATOR. $cmd) and is_executable($full_path)){
            return $full_path;
        }
    }
    return false;
}
while(true){
    fwrite(STDOUT, "$ ");
    $input_command = rtrim(fgets(STDIN), "\r\n");
    $args = explode(' ', $input_command);
    $command = array_shift($args);
    if(get_executable_path($command)){
        exec($command . ' '. $input_command); 
        continue;
    }
    switch($command){
        case 'exit':
            break 2;
        case 'echo':
            fwrite(STDOUT, implode(' ',$args) . "\n");
            break;
        case 'type':
            $cmd = $args[0];
            if(in_array($cmd, $commands)){
                fwrite(STDOUT, $cmd . " is a shell builtin\n");
                break;
            } 
            if($full_path = get_executable_path($cmd)){
                fwrite(STDOUT, $cmd. " is ". $full_path . "\n");
                break;
            }
            fwrite(STDOUT, $cmd . ": not found\n");
            break;
        default:
            fwrite(STDOUT, "{$command}: command not found\n");
            break;
    }
}