<?php
error_reporting(E_ALL);

// TODO: Uncomment the code below to pass the first stage
fwrite(STDOUT, "$ ");
$command = rtrim(fgets(STDIN), "\r\n");
fwrite(STDOUT, "{$command}: command not found");