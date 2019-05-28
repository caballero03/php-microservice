<?php

declare(strict_types=1);

namespace Micro\Container\Infrastructure;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use Psr\Container\ContainerInterface;


class AMQPStreamConnectionFactory
{
    /**
     * @param ContainerInterface $container
     * @return AMQPStreamConnection
     */
    public function __invoke(ContainerInterface $container) : AMQPStreamConnection
    {
        $config = $container->get('config');
        $settings = $config['settings']['amqp'];

        $amqpStreamConnection = new AMQPStreamConnection($settings['host'], $settings['port'], $settings['username'], getenv('RABBIT_PASSWORD'));

        return $amqpStreamConnection;
    }

}