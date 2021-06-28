<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Home\Handler\HomePageHandler;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Router\RouterInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

use function get_class;

class HomePageHandlerTest extends TestCase
{
    use ProphecyTrait;

    /** @var ContainerInterface|ObjectProphecy */
    protected ObjectProphecy|ContainerInterface $container;

    /** @var RouterInterface|ObjectProphecy */
    protected RouterInterface|ObjectProphecy $router;

    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->router    = $this->prophesize(RouterInterface::class);
    }

    public function testReturnsJsonResponse()
    {
        $homePage = new HomePageHandler(
            get_class($this->container->reveal()),
            $this->router->reveal(),
        );

        $response = $homePage->handle(
            $this->prophesize(ServerRequestInterface::class)->reveal()
        );

        self::assertInstanceOf(JsonResponse::class, $response);
    }
}
