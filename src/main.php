<?php

// main.php

require_once __DIR__ . '/../vendor/autoload.php';
$container = require __DIR__ . '/../config/container.php';



while(1) {
    sleep(1);
    
    echo 'Running: ' . date('H:i:s') . PHP_EOL;
}