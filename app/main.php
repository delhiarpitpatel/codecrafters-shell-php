<?php
error_reporting(E_ALL);

function get_executable_path($cmd){
    foreach ( explode(':', $_SERVER['PATH']) as $path){
        if(file_exists($full_path = $path. DIRECTORY_SEPARATOR. $cmd) and is_executable($full_path)){
            return $full_path;
        }
    }
    return false;
}
$commands = [
    'echo', 'cd', 'type', 'pwd', 'exit'
];
while(true){
    fwrite(STDOUT, "$ ");
    $input_command = rtrim(fgets(STDIN), "\r\n");
    $args = explode(' ', $input_command);
    array_filter($args);
    $command = array_shift($args);
    if(!in_array($command, $commands) and get_executable_path($command)){
        system($input_command); 
        continue;
    }
    switch($command){
        case 'exit': break 2;
        case 'cd':
            if($dir = $args[0] and $dir === '~') $dir = $_SERVER['HOME'];
            if(is_dir($dir))    chdir($dir);
            else                fwrite(STDOUT, "cd: " . $dir . ": No such file or directory\n");
            break;
        case 'echo':
            fwrite(STDOUT, implode(' ',$args) . "\n");
            break;
        case 'pwd':
            fwrite(STDOUT, getcwd() . "\n");
            break;
        case 'type':
            if(in_array($cmd = $args[0], $commands))
                fwrite(STDOUT, $cmd . " is a shell builtin\n");
            else if($full_path = get_executable_path($cmd))
                fwrite(STDOUT, $cmd. " is ". $full_path . "\n");
            else
                fwrite(STDOUT, $cmd . ": not found\n");
            break;
        default:
            fwrite(STDOUT, "{$command}: command not found\n");
            break;
    }
}