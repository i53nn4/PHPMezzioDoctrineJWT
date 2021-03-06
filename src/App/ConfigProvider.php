<?php

declare(strict_types=1);

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Home\Handler\PingHandler::class => Home\Handler\PingHandler::class,
            ],
            'factories' => [

                // Home
                Home\Handler\HomePageHandler::class => Home\Factory\HomePageHandlerFactory::class,

                // Auth
                Auth\Handler\TokenJwtHandler::class => Auth\Factory\TokenJwtHandlerFactory::class,
                Auth\Middleware\JwtTokenAuthMiddleware::class => Auth\Factory\JwtTokenAuthMiddlewareFactory::class,
                Auth\Service\AuthService::class => Auth\Service\Factory\AuthServiceFactory::class,

                // Handler
                Model\Handler\ListAllTableHandler::class => Model\Factory\ListAllTableHandlerFactory::class,
                Model\Handler\ListTableHandler::class => Model\Factory\ListTableHandlerFactory::class,
                Model\Handler\CreateTableHandler::class => Model\Factory\CreateTableHandlerFactory::class,
                Model\Handler\UpdateTableHandler::class => Model\Factory\UpdateTableHandlerFactory::class,
                Model\Handler\DeleteTableHandler::class => Model\Factory\DeleteTableHandlerFactory::class,

                // Service
                Model\Service\TableService::class => Model\Factory\TableServiceFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app' => ['templates/app'],
                'error' => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
