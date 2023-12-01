<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
#[Vich\Uploadable]
#[ApiResource]
#[get]
#[Delete(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_EMPLOYEES')")]
#[GetCollection]
#[Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_EMPLOYEES')")]
class Images implements \Serializable
{
    use HasIdTrait;
    use HasTimestampTrait;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'path', size: 'size')]
    #[Groups(['get'])]
    private ?File $file = null;
    #[ORM\Column(nullable: true)]
    #[Groups(['get'])]
    private ?string $path = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get'])]
    private ?int $size = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Cars $car = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Users $user = null;

    public function setFile(File|UploadedFile|null $file): Images
    {
        $this->file = $file;

        if (null !== $file) {
            $this->setUpdatedAt(new \DateTime());
        }

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getCar(): ?Cars
    {
        return $this->car;
    }

    public function setCar(?Cars $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getPath();
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /** @see \Serializable::serialize() */
    public function serialize(): ?string
    {
        return serialize([
            $this->id,
            $this->path,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($data): void
    {
        list(
            $this->id,
            $this->path,
        ) = unserialize($data, ['allowed_classes' => false]);
    }

    public function __serialize(): array
    {
        return [
            $this->id,
            $this->path,
        ];
    }

    /**
     * @param array<mixed> $data
     */
    public function __unserialize(array $data): void
    {
        list(
            $this->id,
            $this->path,
        ) = $data;
    }
}
