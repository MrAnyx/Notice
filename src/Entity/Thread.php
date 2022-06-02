<?php

namespace App\Entity;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ThreadRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ThreadRepository::class)]
class Thread
{
    #[ORM\Id]
    #[ORM\Column(type:"uuid", unique:true)]
    #[ORM\GeneratedValue(strategy:"CUSTOM")]
    #[ORM\CustomIdGenerator(class:UuidGenerator::class)]
    private $id;

    #[ORM\Column(type: 'string', length: 270)]
    #[Assert\NotBlank]
    #[Assert\Length(
        max: 270,
        maxMessage: 'Your thread content cannot be longer than {{ limit }} characters',
    )]
    private $content;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'threads')]
    private $author;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\DateTime]
    private $createdAt;

    #[ORM\Column(type:"uuid")]
    #[Assert\Uuid]
    private $threadId;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    private $parent;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class, cascade:["remove"])]
    private $children;

    #[ORM\Column(type: 'boolean', options:["default" => false])]
    private $restricted;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'likes', cascade:["remove"])]
    private $likedBy;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
        $this->restricted = false;
        $this->likedBy = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getThreadId(): ?Uuid
    {
        return $this->threadId;
    }

    public function setThreadId(Uuid $threadId): self
    {
        $this->threadId = $threadId;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function isRestricted(): ?bool
    {
        return $this->restricted;
    }

    public function setRestricted(bool $restricted): self
    {
        $this->restricted = $restricted;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getLikedBy(): Collection
    {
        return $this->likedBy;
    }

    public function addLikedBy(User $likedBy): self
    {
        if (!$this->likedBy->contains($likedBy)) {
            $this->likedBy[] = $likedBy;
        }

        return $this;
    }

    public function removeLikedBy(User $likedBy): self
    {
        $this->likedBy->removeElement($likedBy);

        return $this;
    }
}
