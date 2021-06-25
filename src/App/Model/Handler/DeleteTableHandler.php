<?php

declare(strict_types=1);

namespace App\Model\Handler;

use App\Base\Handler\HandlerAbstract;
use App\Model\Service\TableService;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteTableHandler extends HandlerAbstract implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $id = (int)$request->getAttribute('id');

            /**
             * @var TableService $service
             */
            $service = $this->container->get(TableService::class);

            $service->delete($id);

            $response = $this->successResponse(['message' => 'Registro deletado com sucesso!']);

        } catch (Exception $e) {
            $response = $this->errorResponse('Erro ao deletar o registro!');
        }

        return $response;
    }
}