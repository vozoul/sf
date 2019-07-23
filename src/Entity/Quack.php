<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Tests\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuackRepository")
 * @uniqueEntity("title")
 */
class Quack
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="string", length=90, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $comments = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", mappedBy="quacks")
     */
    private $my_tags;

    public function __construct()
    {
        $this->create_at = new \DateTime();
        $this->my_tags = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getComments(): ?array
    {
        return $this->comments;
    }

    public function setComments(?array $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Tags[]
     */
    public function getMyTags(): Collection
    {
        return $this->my_tags;
    }

    public function addMyTag(Tags $myTag): self
    {
        if (!$this->my_tags->contains($myTag)) {
            $this->my_tags[] = $myTag;
            $myTag->addQuack($this);
        }

        return $this;
    }

    public function removeMyTag(Tags $myTag): self
    {
        if ($this->my_tags->contains($myTag)) {
            $this->my_tags->removeElement($myTag);
            $myTag->removeQuack($this);
        }

        return $this;
    }
}
