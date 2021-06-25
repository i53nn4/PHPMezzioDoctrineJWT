<?php

declare(strict_types=1);

namespace App\Model\Handler\Factory;

use App\Base\Handler\HandlerAbstract;
use App\Model\Handler\CreateTableHandler;
use Psr\Container\ContainerInterface;

class CreateTableHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return HandlerAbstract
     */
    public function __invoke(ContainerInterface $container): HandlerAbstract
    {
        return new CreateTableHandler($container);
    }
}