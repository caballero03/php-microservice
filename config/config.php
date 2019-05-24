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

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

 $cacheConfig = [
     'config_cache_path' => 'data/config-cache.php',
     ConfigAggregator::ENABLE_CACHE => false,
//     'config_cache_path' => __DIR__ . '/../../../writable/cache/config-cache.php',
 ];

$aggregator = new ConfigAggregator([
     new ArrayProvider($cacheConfig),

    new PhpFileProvider(__DIR__ . '/autoload/{{,*.}global,{,*.}local}.php'),
//    new PhpFileProvider(__DIR__ . '/../settings.php'), // Load Slim settings too
//     new PhpFileProvider('config/development.config.php'),
 ], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
