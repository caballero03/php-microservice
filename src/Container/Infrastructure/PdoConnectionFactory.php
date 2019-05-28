<?php

declare(strict_types=1);

namespace Micro\Container\Infrastructure;

use Interop\Config\ConfigurationTrait;
use Interop\Config\ProvidesDefaultOptions;
use Interop\Config\RequiresConfigId;
use Interop\Config\RequiresMandatoryOptions;
use PDO;
//use Prooph\EventStore\Pdo\Exception\InvalidArgumentException;
use Psr\Container\ContainerInterface;

class PdoConnectionFactory implements ProvidesDefaultOptions, RequiresConfigId, RequiresMandatoryOptions
{
    use ConfigurationTrait;

    /**
     * @var string
     */
    private $configId;

    /**
     * Creates a new instance from a specified config, specifically meant to be used as static factory.
     *
     * In case you want to use another config key than provided by the factories, you can add the following factory to
     * your config:
     *
     * <code>
     * <?php
     * return [
     *     PDO::class => [PdoConnectionFactory::class, 'mysql'],
     * ];
     * </code>
     *
     * @throws //InvalidArgumentException
     */
    public static function __callStatic(string $name, array $arguments): PDO
    {
        if (! isset($arguments[0]) || ! $arguments[0] instanceof ContainerInterface) {
            throw new \Exception(
                \sprintf('The first argument must be of type %s', ContainerInterface::class)
            );
        }

        return (new static($name))->__invoke($arguments[0]);
    }

    public function __construct(string $configId = 'default')
    {
        $this->configId = $configId;
    }

    public function __invoke(ContainerInterface $container): PDO
    {
//        $config = $container->get('config');
//        $config = $this->options($config, $this->configId);

        $config = [
            'schema' => 'mysql',
            'host' => getenv('DATABASE_HOST'),
            'port' => '3306',
            'user' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
            'dbname' => getenv('MYSQL_DATABASE'),
            'charset' => 'utf8'
        ];

        return new PDO(
            $this->buildConnectionDns($config),
            $config['user'],
            $config['password']
        );
    }

    public function dimensions(): iterable
    {
        return [
            'prooph',
            'pdo_connection',
        ];
    }

    public function defaultOptions(): iterable
    {
        return [
            'host' => '127.0.0.1',
            'dbname' => 'event_store',
            'charset' => 'utf8',
        ];
    }

    public function mandatoryOptions(): iterable
    {
        return [
            'schema',
            'user',
            'password',
            'port',
        ];
    }

    private function buildConnectionDns(array $params): string
    {
        $dsn = $params['schema'] . ':';

        if ($params['host'] !== '') {
            $dsn .= 'host=' . $params['host'] . ';';
        }

        if ($params['port'] !== '') {
            $dsn .= 'port=' . $params['port'] . ';';
        }

        $dsn .= 'dbname=' . $params['dbname'] . ';';

        if ('mysql' === $params['schema']) {
            $dsn .= 'charset=' . $params['charset'] . ';';
        } elseif ('pgsql' === $params['schema']) {
            $dsn .= "options='--client_encoding=".$params['charset']."'";
        }

        return $dsn;
    }
}
