<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 */
class Blog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $content;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $createdDate;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $postedDate;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $modifiedDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedDate(): ?string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(string $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getPostedDate(): ?string
    {
        return $this->postedDate;
    }

    public function setPostedDate(?string $postedDate): self
    {
        $this->postedDate = $postedDate;

        return $this;
    }

    public function getModifiedDate(): ?string
    {
        return $this->modifiedDate;
    }

    public function setModifiedDate(string $modifiedDate): self
    {
        $this->modifiedDate = $modifiedDate;

        return $this;
    }
}
