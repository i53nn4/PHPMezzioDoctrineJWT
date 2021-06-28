<?php

declare(strict_types=1);

namespace App\Model\Factory;

use App\Base\Handler\HandlerAbstract;
use App\Model\Handler\ListAllTableHandler;
use Psr\Container\ContainerInterface;

class ListAllTableHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return HandlerAbstract
     */
    public function __invoke(ContainerInterface $container): HandlerAbstract
    {
        return new ListAllTableHandler($container);
    }
}