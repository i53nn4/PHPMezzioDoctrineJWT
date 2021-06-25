<?php

declare(strict_types=1);

namespace App\Auth\Handler;

use App\Auth\Service\AuthService;
use App\Base\Handler\HandlerAbstract;
use Laminas\Json\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Firebase\JWT\JWT;
use DateInterval;
use DateTime;
use Exception;

class TokenJwtHandler extends HandlerAbstract implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = Json::decode($request->getBody()->getContents(), JSON_OBJECT_AS_ARRAY);

        if (!empty($validation = $this->validation($data))) {
            return $this->errorValidationResponse($validation);
        }

        try {

            /**
             * @var AuthService $service
             */
            $service = $this->container->get(AuthService::class);
            $config = $this->container->get('config');

            $result = $service->getUserByLoginPassword($data['login'], $data['password']);

            if (empty($result)) {
                throw new Exception('Não foi possível gerar o token: usuário não encontrado.', 401);
            }

            $expiryPeriod = (new DateTime())->add(new DateInterval($config['auth']['jwt']['expiryPeriod']))->getTimestamp();

            $payload = [
                "sub" => $result['id'],
                "iss" => $config['auth']['jwt']['claim']['iss'],
                "aud" => $config['auth']['jwt']['claim']['aud'],
                "iat" => (new DateTime())->getTimestamp(),
                "nbf" => (new DateTime())->getTimestamp(),
                "exp" => $expiryPeriod,
            ];

            $token = JWT::encode($payload, $_ENV['AUTH_JWT_KEY']);

            $response = $this->successResponse([
                'resource' => 'Authorization',
                'token' => $token,
                'expires' => $expiryPeriod,
            ]);

        } catch (Exception | \Doctrine\DBAL\Driver\Exception $e) {

            $response = $this->errorExceptionResponse($e);
        }

        return $response;
    }

    /**
     * @param array $params
     * @return bool|array
     */
    private function validation(array $params): bool|array
    {
        $return = [];

        if (!isset($params['login']) or empty($params['login'])) {
            $this->addError('login', 'Login é obrigatório');
        }

        if (!isset($params['password']) or empty($params['password'])) {
            $this->addError('password', 'Password é obrigatório');
        }

        if ($this->error()) {
            $return = $this->error();
        }

        return $return;
    }
}