<?php

// main.php

namespace Micro;

require_once __DIR__ . '/../vendor/autoload.php';
$container = require __DIR__ . '/../config/container.php';

use Micro\Model\Test\Test;

$test = new Test($container);

while(1) {
    sleep(1);
    
//    echo 'Running: ' . date('H:i:s') . PHP_EOL;

    $test->test();
}