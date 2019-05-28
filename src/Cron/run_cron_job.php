<?php

/*
 * Main CRON entry point
 */

declare(strict_types=1);

namespace Micro;

require_once __DIR__ . '/../../vendor/autoload.php';
$container = require __DIR__ . '/../../config/container.php';


echo 'Cron just ran: ' . date('Y-m-d H:i:s') . PHP_EOL;
