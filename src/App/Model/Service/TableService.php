<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Base\Service\ServiceAbstract;
use App\Model\Entity\Schema\Table;

class TableService extends ServiceAbstract
{
    /**
     * @var string
     */
    protected string $entity = Table::class;
}