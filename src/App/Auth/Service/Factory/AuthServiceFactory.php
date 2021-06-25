<?php

declare(strict_types=1);

namespace App\Auth\Service\Factory;

use App\Auth\Service\AuthService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class AuthServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return AuthService
     */
    public function __invoke(ContainerInterface $container): AuthService
    {
        $entityManager = $container->get(EntityManager::class);
        return new  AuthService($entityManager);
    }
}