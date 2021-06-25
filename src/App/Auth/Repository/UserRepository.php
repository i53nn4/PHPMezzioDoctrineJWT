<?php

declare(strict_types=1);

namespace App\Auth\Repository;

use App\Base\Repository\RepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Exception;

class UserRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * @return array
     * @throws Exception
     */
    public function getAll(): array
    {
        return [];
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getOne(int $id): array
    {
        return [];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllWithSQL(): array
    {
        return [];
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getOneWithSQL(int $id): array
    {
        return [];
    }

    /**
     * @param string $login
     * @param string $password
     * @return array
     * @throws Exception|\Doctrine\DBAL\Driver\Exception
     */
    public function getUserByLoginPassword(string $login, string $password): array
    {
        $sql = 'SELECT id
                     , login 
                  FROM test.user
                 WHERE login = :login
                   AND password = md5 (
                        (SELECT id 
                           FROM test.user 
                          WHERE login = :login) || :password);';

        try {

            $query = $this->getEntityManager()->getConnection()->prepare($sql);

            $query->bindValue('login', $login);
            $query->bindValue('password', $password);

            $query->execute();

            $result = $query->fetchAssociative();

            return !empty($result) ? $result : [];

        } catch (Exception $e) {

            throw $e;
        }
    }
}