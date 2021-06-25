<?php

declare(strict_types=1);

namespace App\Home\Factory;

use Mezzio\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Home\Handler\HomePageHandler;

use function get_class;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $router = $container->get(RouterInterface::class);

        return new HomePageHandler(get_class($container), $router);
    }
}
