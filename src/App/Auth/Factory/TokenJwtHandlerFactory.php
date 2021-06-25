<?php

declare(strict_types=1);

namespace App\Auth\Factory;

use App\Auth\Handler\TokenJwtHandler;
use App\Base\Handler\HandlerAbstract;;
use Psr\Container\ContainerInterface;

class TokenJwtHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return HandlerAbstract
     */
    public function __invoke(ContainerInterface $container): HandlerAbstract
    {
        return new TokenJwtHandler($container);
    }
}