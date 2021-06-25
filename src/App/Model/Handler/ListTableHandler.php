<?php

declare(strict_types=1);

namespace App\Model\Handler;

use App\Base\Handler\HandlerAbstract;
use App\Model\Service\TableService;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListTableHandler extends HandlerAbstract implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int)$request->getAttribute('id');

        try {

            /**
             * @var TableService $service
             */
            $service = $this->container->get(TableService::class);

            $result['getOne'] = $service->getOne($id);
            $result['getAllWithSQL'] = $service->getOneWithSQL($id);

            $response = $this->successResponse($result);

        } catch (Exception $e) {

            $response = $this->errorResponse('Nenhum registro encontrado');
        }

        return $response;
    }
}