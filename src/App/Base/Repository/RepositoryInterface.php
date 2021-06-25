<?php

declare(strict_types=1);

namespace App\Base\Repository;

interface RepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return array
     */
    public function getOne(int $id): array;

    /**
     * @return array
     */
    public function getAllWithSQL(): array;

    /**
     * @param int $id
     * @return array
     */
    public function getOneWithSQL(int $id): array;

}