<?php

declare(strict_types=1);

namespace App\Model\Handler;

use App\Base\Handler\HandlerAbstract;
use App\Model\Service\TableService;
use Exception;
use Laminas\Json\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UpdateTableHandler extends HandlerAbstract implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $data = Json::decode($request->getBody()->getContents(), JSON_OBJECT_AS_ARRAY);

            $data['id'] = (int)$request->getAttribute('id');

            /**
             * @var TableService $service
             */
            $service = $this->container->get(TableService::class);

            $userType = $service->insert($data);

            $response = $this->successResponse($userType);

        } catch (Exception $e) {
            $response = $this->errorResponse('Erro ao atualizar o registro!');
        }

        return $response;
    }
}