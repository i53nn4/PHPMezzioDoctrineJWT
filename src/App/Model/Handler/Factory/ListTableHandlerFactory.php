<?php

declare(strict_types=1);

namespace App\Model\Handler\Factory;

use App\Base\Handler\HandlerAbstract;
use App\Model\Handler\ListTableHandler;
use Psr\Container\ContainerInterface;

class ListTableHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return HandlerAbstract
     */
    public function __invoke(ContainerInterface $container): HandlerAbstract
    {
        return new ListTableHandler($container);
    }
}