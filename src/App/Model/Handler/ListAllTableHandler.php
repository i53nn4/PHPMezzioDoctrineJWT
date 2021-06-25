<?php

declare(strict_types=1);

namespace App\Model\Handler;

use App\Base\Handler\HandlerAbstract;
use App\Model\Service\TableService;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListAllTableHandler extends HandlerAbstract implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {

            /**
             * @var TableService $service
             */
            $service = $this->container->get(TableService::class);

            $result['getAll'] = $service->getAll();
            $result['getAllWithSQL'] = $service->getAllWithSQL();

            $response = $this->successResponse($result);

        } catch (Exception $e) {

            $response = $this->errorResponse('Nenhum registro encontrado');
        }

        return $response;
    }
}