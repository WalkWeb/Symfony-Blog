<?php

namespace App\Entity;

use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\IdTrait;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, inversedBy="tags")
     */
    private $posts;

    // TODO icon

    // TODO translate

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->posts = new ArrayCollection();
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

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
        }

        return $this;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function removePost(Post $post): self
    {
        $this->posts->removeElement($post);

        return $this;
    }
}
