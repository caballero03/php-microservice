<?php

/**
 * This file is part of muse/museconcept.
 * (c) 2018-2019 Muse Concept <keith@museconcept.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Micro\Container\Infrastructure;

use Psr\Container\ContainerInterface;
use Predis\Client as RedisClient;

class RedisClientFactory
{
    /**
     * @param ContainerInterface $container
     * @return RedisClient
     */
    public function __invoke(ContainerInterface $container) : RedisClient
    {
//        $config = $container->get('config');
//        $settings = $config['settings']['microservice']['redis'];

        $redisClient = new RedisClient([
            'host' => getenv('REDIS_HOSTNAME'),
            'port' =>  6379,
            'password' =>  getenv('REDIS_PASSWORD'),
            'database' => 0
        ],
            [
                'prefix' => getenv('REDIS_PREFIX')  // Custom prefix for keys
            ]
        );

        return $redisClient;
    }

}