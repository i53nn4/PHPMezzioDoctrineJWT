<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Base\Repository\RepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Exception;

class TableRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * @return array
     * @throws Exception
     */
    public function getAll(): array
    {
        try {
            $data = $this->findAll();
            $dataArray = [];

            foreach ($data as $object) {
                $dataArray[] = $object->toArray();
            }

            return $dataArray;
        } catch (Exception $e) {

            throw $e;
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getOne(int $id): array
    {
        try {
            $entity = $this->findOneBy(['id' => $id]);

            return !empty($entity) ? $entity->toArray() : [];

        } catch (Exception $e) {

            throw $e;
        }
    }

    /**
     * @return array
     * @throws Exception|\Doctrine\DBAL\Driver\Exception
     */
    public function getAllWithSQL(): array
    {
        $sql = 'SELECT * FROM test.table;';

        try {

            $query = $this->getEntityManager()->getConnection()->prepare($sql);
            $query->execute();

            $result = $query->fetchAllAssociative();

            return $result ?? [];

        } catch (Exception $e) {

            throw $e;
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception|\Doctrine\DBAL\Driver\Exception
     */
    public function getOneWithSQL(int $id): array
    {
        $sql = 'SELECT * FROM test.table WHERE id = :id;';

        try {

            $query = $this->getEntityManager()->getConnection()->prepare($sql);

            $query->bindValue('id', $id);

            $query->execute();

            $result = $query->fetchAssociative();

            return !empty($result) ? $result : [];

        } catch (Exception $e) {

            throw $e;
        }
    }
}