<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
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
     * @ORM\Column(type="integer")
     */
    private $blogId;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $commentTitle;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $commentDiscription;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $createdDate;

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

    public function getBlogId(): ?int
    {
        return $this->blogId;
    }

    public function setBlogId(int $blogId): self
    {
        $this->blogId = $blogId;

        return $this;
    }

    public function getCommentTitle(): ?string
    {
        return $this->commentTitle;
    }

    public function setCommentTitle(string $commentTitle): self
    {
        $this->commentTitle = $commentTitle;

        return $this;
    }

    public function getCommentDiscription(): ?string
    {
        return $this->commentDiscription;
    }

    public function setCommentDiscription(?string $commentDiscription): self
    {
        $this->commentDiscription = $commentDiscription;

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
}
