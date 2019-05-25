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

use Micro\Container\Infrastructure\RedisClientFactory;
use Monolog\Logger;
use PhpAmqpLib\Connection\AMQPStreamConnection;
//use Micro\Container\Infrastructure\AMQPStreamConnectionFactory;

return [
    'settings' => [
        'microservice' => [

        ],
    ],

    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
//             Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],

        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [

            // Redis Client Factory
            'redis.client' => RedisClientFactory::class,

//
//            // RabbitMQ Connection Factory
//            AMQPStreamConnection::class => AMQPStreamConnectionFactory::class,
//
//            // Monolog logger class
//            Logger::class => LoggerFactory::class,

        ],

    ],

];