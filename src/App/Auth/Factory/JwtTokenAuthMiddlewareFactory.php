<?php

declare(strict_types=1);

namespace App\Auth\Factory;

use App\Auth\Middleware\JwtTokenAuthMiddleware;
use App\Base\Handler\HandlerAbstract;
use Psr\Container\ContainerInterface;

class JwtTokenAuthMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     * @return JwtTokenAuthMiddleware
     */
    public function __invoke(ContainerInterface $container): HandlerAbstract
    {
        return new JwtTokenAuthMiddleware($container);
    }
}