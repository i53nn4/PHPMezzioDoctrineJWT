<?php

declare(strict_types=1);

namespace App\Base\Handler;

use App\Base\Useful\Validation;
use Doctrine\DBAL\Exception\DriverException;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use PDOException;
use Psr\Container\ContainerInterface;

abstract class HandlerAbstract
{

    /**
     * @var Validation
     */
    use Validation;

    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * HandlerAbstract constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $response
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function successResponse(array $response, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse(['success' => true, 'data' => $response], $statusCode);
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $statusCode = 400): JsonResponse
    {
        $return['success'] = false;
        $return['status_code'] = $statusCode;
        $return['error'][]['message'] = $message;

        return new JsonResponse($return, $statusCode);
    }

    /**
     * @param Exception $exception
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorExceptionResponse(Exception $exception, int $statusCode = 400): JsonResponse
    {
        $return['success'] = false;
        $return['status_code'] = $exception->getCode();

        if ($exception->getCode() === 0) {
            $return['status_code'] = $statusCode;
        }

        $message = $exception->getMessage();

        if (($exception instanceof DriverException) or ($exception instanceof PDOException)) {
            $message = 'Ops! Encontramos um erro.';

            if (($_ENV['SHOW_ERROR_DEVELOPER_API'] == 'true')) {
                $return['error'][]['message_developer'] = $exception->getMessage();
            }
        }

        $return['error'][]['message'] = $message;

        return new JsonResponse($return, $statusCode);
    }
}