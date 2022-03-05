<?php

namespace App\Entity;

use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\IdTrait;
use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Tag
{
    use IdTrait;
    use CreatedAtTrait;

    /**
     * Название тега
     *
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * Является ли тег одобренным
     *
     * Одобренные теги отображаются в подсказках при наборе тегов
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":"0"})
     * @var bool
     */
    private $approved = false;

    // TODO icon

    // TODO translate

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->approved;
    }

    public function approved(): void
    {
        $this->approved = true;
    }
}
