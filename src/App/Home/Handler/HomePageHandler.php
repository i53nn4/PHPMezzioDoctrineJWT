<?php

declare(strict_types=1);

namespace App\Home\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    /**
     * @var string
     */
    protected string $containerName;

    /**
     * @var Router\RouterInterface
     */
    protected Router\RouterInterface $router;

    /**
     * HomePageHandler constructor.
     * @param string $containerName
     * @param Router\RouterInterface $router
     */
    public function __construct(string $containerName, Router\RouterInterface $router)
    {
        $this->containerName = $containerName;
        $this->router = $router;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([
            'welcome' => 'Bem-vindo!',
            'url' => $_SERVER['HTTP_HOST'],
        ]);
    }
}
