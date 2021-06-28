<?php

declare(strict_types=1);

namespace App\Auth\Service;

use App\Auth\Entity\UserEntity;
use App\Auth\Repository\UserRepository;
use App\Base\Service\ServiceAbstract;
use Exception;

class AuthService extends ServiceAbstract
{
    /**
     * @var string
     */
    protected string $entity = UserEntity::class;

    /**
     * @param string $login
     * @param string $password
     * @return array
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function getUserByLoginPassword(string $login, string $password): array
    {
        try {

            /**
             * @var UserRepository $repository
             */
            $repository = $this->entityManager->getRepository($this->entity);

            if ($this->validationPassword($password) === true) {
                throw new Exception('Não foi possível gerar o token: senha inválida.', 401);
            }

            return $repository->getUserByLoginPassword($login, $this->decryptPassword($password));

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param string $password
     * @return bool
     * @throws Exception
     */
    private function validationPassword(string $password): bool
    {
        $error = false;
        $return = openssl_decrypt($password, 'AES-128-ECB', 'Un1Su4m');

        if (!$return) {
            $error = true;
        }

        return $error;
    }

    /**
     * @param string $password
     * @return string
     */
    private function decryptPassword(string $password): string
    {
        return openssl_decrypt($password, 'AES-128-ECB', 'Un1Su4m');
    }

    /**
     * @param string $password
     * @return string
     */
    private function encryptPassword(string $password): string
    {
        return openssl_encrypt($password, 'AES-128-ECB', 'Un1Su4m');
    }
}