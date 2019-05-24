<?php
/**
 * This file is part of muse/museconcept.
 * (c) 2018-2019 Muse Concept <keith@museconcept.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Config;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

// Load configuration
$config = require __DIR__ . '/config.php';

// Build container
$container = new ServiceManager();
$container->setAllowOverride(true);
(new Config($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);

return $container;
