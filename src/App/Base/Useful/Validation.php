<?php


namespace App\Base\Useful;

use Laminas\Diactoros\Response\JsonResponse;

trait Validation
{

    /**
     * @var array
     */
    private array $_errors = [];

    /**
     * @param string $item
     * @param string $error
     */
    protected function addError(string $item, string $error)
    {
        $this->_errors[][$item] = $error;
    }


    /**
     * @return array|bool
     */
    protected function error(): bool|array
    {
        if (empty($this->_errors)) return false;
        return $this->_errors;
    }

    /**
     * @param array $response
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorValidationResponse(array $response, int $statusCode = 400): JsonResponse
    {
        $return['success'] = false;
        $return['status_code'] = $statusCode;
        $return['error'] = $response;

        return new JsonResponse($return, $statusCode);
    }
}