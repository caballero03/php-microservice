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

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;

use Micro\Container\Infrastructure\PdoConnectionFactory;
use TacticianModule\Factory\CommandBusFactory;
use TacticianModule\Factory\CommandHandlerMiddlewareFactory;
use TacticianModule\Factory\InMemoryLocatorFactory;
use TacticianModule\Factory\Plugin\DoctrineTransactionFactory;
use TacticianModule\Locator\ClassnameZendLocator;
use TacticianModule\Locator\ClassnameZendLocatorFactory;
use TacticianModule\Locator\ZendLocator;
use TacticianModule\Locator\ZendLocatorFactory;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Micro\Container\Infrastructure\AMQPStreamConnectionFactory;

use Micro\Container\Infrastructure\RedisClientFactory;
use Monolog\Logger;


return [
    'settings' => [
        'microservice' => [

        ],

        // RabbitMQ instance config settings
        'amqp' => [
            'host' => 'rabbitmq-service',
            'port' => 5672,
            'username' => 'guest'
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
            // League Tactician
            CommandBus::class               => CommandBusFactory::class,
            CommandHandlerMiddleware::class => CommandHandlerMiddlewareFactory::class,
            InMemoryLocator::class          => InMemoryLocatorFactory::class,
            ClassnameZendLocator::class     => ClassnameZendLocatorFactory::class,
            ZendLocator::class              => ZendLocatorFactory::class,
            'League\Tactician\Doctrine\ORM\TransactionMiddleware' => DoctrineTransactionFactory::class,


            // Redis Client Factory
            'redis.client' => RedisClientFactory::class,

            // PDO Client Factory
            'pdo.connection' => PdoConnectionFactory::class,

//
//            // RabbitMQ Connection Factory
            AMQPStreamConnection::class => AMQPStreamConnectionFactory::class,

//            // Monolog logger class
//            Logger::class => LoggerFactory::class,

        ],

    ],

    // League Tactician
    'tactician' => [
        'default-extractor'  => ClassNameExtractor::class,
        'default-locator'    => ZendLocator::class,
        'default-inflector'  => InvokeInflector::class, //HandleInflector::class
        'handler-map'        => [
//            RegisterUser::class => \Muse\Model\User\Handler\RegisterUserHandler::class,

        ],
        'middleware'         => [
            CommandHandlerMiddleware::class => 0,
        ],
    ],

];