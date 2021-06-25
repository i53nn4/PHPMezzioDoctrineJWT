<?php

declare(strict_types=1);

namespace App\Model\Service\Factory;

use App\Model\Service\TableService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class TableServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return TableService
     */
    public function __invoke(ContainerInterface $container): TableService
    {
        $entityManager = $container->get(EntityManager::class);
        return new  TableService($entityManager);
    }
}