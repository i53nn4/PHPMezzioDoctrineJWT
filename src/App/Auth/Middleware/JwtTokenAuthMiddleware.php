<?php

declare(strict_types=1);

namespace App\Auth\Middleware;

use App\Base\Handler\HandlerAbstract;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use UnexpectedValueException;

class JwtTokenAuthMiddleware extends HandlerAbstract implements MiddlewareInterface
{

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getMethod() == 'OPTIONS') {
            return $this->successResponse([]);
        }

        $authHeader = $request->getHeaderLine('Authorization');

        if (!empty($validation = $this->validationAuthorization($authHeader))) {
            return $this->errorValidationResponse($validation, 401);
        }

        try {
            $return = $this->hasValidToken($authHeader);

        } catch (Exception | UnexpectedValueException $e) {

            return $this->errorResponse('Token inválido.', 401);
        }

        return $handler->handle($request->withAttribute('user_id', $return['sub']));
    }

    /**
     * Validate the supplied JWT Token's payload
     *
     * @param string $authHeader
     * @return array
     */
    private function hasValidToken(string $authHeader): array
    {
        $config = $this->container->get('config');

        JWT::$leeway = $config['auth']['jwt']['leeway'];

        $payload = JWT::decode(
            $authHeader,
            $_ENV['AUTH_JWT_KEY'],
            $config['auth']['jwt']['allowedAlgorithms']
        );

        $timestamp = (new DateTime())->getTimestamp();

        return ['sub' => $payload->sub, 'isValid' => (
            $payload->iss !== $config['auth']['jwt']['claim']['iss'] ||
            $payload->aud !== $config['auth']['jwt']['claim']['aud'] ||
            $payload->nbf < $timestamp ||
            $payload->exp > $timestamp
        )];
    }

    /**
     * @param $authHeader
     * @return array|bool
     */
    private function validationAuthorization($authHeader): bool|array
    {
        $return = [];

        if (empty($authHeader)) {
            $this->addError('authorization', 'Falta parâmetro Authorization');
        }

        if ($this->error()) {
            $return = $this->error();
        }

        return $return;
    }
}
