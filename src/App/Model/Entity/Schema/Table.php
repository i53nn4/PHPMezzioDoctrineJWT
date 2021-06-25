<?php

declare(strict_types=1);

namespace App\Model\Entity\Schema;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * Table
 *
 * @ORM\Table(name="test.table")
 * @ORM\Entity(repositoryClass="App\Model\Repository\TableRepository")
 */
class Table
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=100, nullable=true, options={"comment"="Descrição"})
     */
    protected string $descricao = '';

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=20, nullable=true, options={"comment"="Label"})
     */
    protected string $label = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="Data de criação"})
     */
    protected \DateTime $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"comment"="Data de alteração"})
     */
    protected ?\DateTime $updatedAt = null;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true, options={"comment"="Data de exclusão"})
     */
    protected ?\DateTime $deletedAt = null;

    /**
     * Table constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->createdAt = new \DateTime('now');
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
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return Table
     */
    public function setDescricao(string $descricao): Table
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Table
     */
    public function setLabel(string $label): Table
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Table
     */
    public function setCreatedAt(): Table
    {
        $this->createdAt = new \DateTime('now');
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return Table
     */
    public function setUpdatedAt(): Table
    {
        $this->updatedAt = new \DateTime('now');
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @return Table
     */
    public function setDeletedAt(): Table
    {
        $this->deletedAt = new \DateTime('now');
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return (new ClassMethodsHydrator())->extract($this);
    }

}
