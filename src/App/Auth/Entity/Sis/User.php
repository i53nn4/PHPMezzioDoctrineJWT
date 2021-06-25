<?php

declare(strict_types=1);

namespace App\Auth\Entity\Sis;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * Table
 *
 * @ORM\Table(name="sis.usuarios")
 * @ORM\Entity(repositoryClass="App\Auth\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected int $id;

    /**
     * Table constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        (new ClassMethodsHydrator())->hydrate($data, $this);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return (new ClassMethodsHydrator())->extract($this);
    }

}
