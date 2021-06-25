<?php


declare(strict_types=1);

namespace App\Base\Service;

use Doctrine\ORM\EntityManager;
use Exception;
use Laminas\Hydrator\ClassMethodsHydrator;

abstract class ServiceAbstract
{

    /**
     * @var EntityManager
     */
    protected EntityManager $entityManager;

    /**
     * @var string
     */
    protected string $entity;

    /**
     * ServiceAbstract constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll(): array
    {
        try {
            $repository = $this->entityManager->getRepository($this->entity);

            return $repository->getAll();

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
            $repository = $this->entityManager->getRepository($this->entity);

            return $repository->getOne($id);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllWithSQL(): array
    {
        try {
            $repository = $this->entityManager->getRepository($this->entity);

            return $repository->getAllWithSQL();

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getOneWithSQL(int $id): array
    {
        try {
            $repository = $this->entityManager->getRepository($this->entity);

            return $repository->getOneWithSQL($id);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function insert(array $data): array
    {
        try {
            $entity = new $this->entity();
            $classMethods = new ClassMethodsHydrator();

            $classMethods->hydrate($data, $entity);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            return $entity->toArray();

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function update(array $data): array
    {
        try {
            $entity = $this->entityManager->getReference($this->entity, $data['id']);

            $classMethods = new ClassMethodsHydrator();

            $classMethods->hydrate($data, $entity);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            return $entity->toArray();

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int $id
     * @throws Exception
     */
    public function delete(int $id): void
    {
        try {
            $entity = $this->entityManager->getReference($this->entity, $id);

            $this->entityManager->remove($entity);
            $this->entityManager->flush();

        } catch (Exception $e) {
            throw $e;
        }
    }

}