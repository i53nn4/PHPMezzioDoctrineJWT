<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Base\Service\ServiceAbstract;
use App\Model\Entity\TableEntity;

class TableService extends ServiceAbstract
{
    /**
     * @var string
     */
    protected string $entity = TableEntity::class;
}