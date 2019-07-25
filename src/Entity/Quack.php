<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Tests\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuackRepository")
 * Vich\Uploadable()
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
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $imageFilename;

    /**
     * @var File|null
     * Vich\UploadableField(mapping="quack_image", fileNameProperty="filename")
     * Assert\Image(
     *     mimeType="image/jpeg"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", inversedBy="quacks")
     */
    private $my_tags;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    /**
     * @return string|null
     */
    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    /**
     * @param string|null $imageFilename
     * @return Quack
     * @throws \Exception
     */
    public function setImageFilename(?string $imageFilename): Quack
    {
        $this->imageFilename = $imageFilename;
        if($this->imageFilename instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @param File|null $imageFile
     * @return Quack
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): Quack
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }



}
