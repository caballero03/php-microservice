<?php


namespace Micro\Model\Test;


use Psr\Container\ContainerInterface;

class Test
{
    /* @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function test() {
        echo 'Running: ' . date('H:i:s') . PHP_EOL;
    }
}