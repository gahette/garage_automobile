<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Entity\Traits\HasContentTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasPriceTrait;
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
#[ORM\Entity(repositoryClass: CarsRepository::class)]
#[ApiResource]
#[Get]
#[Patch(security: "is_granted('ROLE_Admin') or is_granted('ROLE_EMPLOYEES')")]
#[Delete(security: "is_granted('ROLE_Admin') or is_granted('ROLE_EMPLOYEES')")]
#[GetCollection]
#[Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_EMPLOYEES')")]
class Cars
{
    use HasIdTrait;
    use HasNameTrait;
    use HasContentTrait;
    use HasPriceTrait;
    use HasTimestampTrait;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $model = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get'])]
    private ?int $kilometer = null;

    #[ORM\Column]
    #[Groups(['get'])]
    private ?string $year = null;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Images::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[Groups(['get'])]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'hasCars')]
    #[Groups(['get'])]
    private ?Garage $garage = null;

    /**
     * @var Collection<int, Messages>
     */
    #[ORM\OneToMany(mappedBy: 'cars', targetEntity: Messages::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $message;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Users $user = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->message = new ArrayCollection();
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getKilometer(): ?int
    {
        return $this->kilometer;
    }

    public function setKilometer(?int $kilometer): static
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): static
    {
        $this->garage = $garage;

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Messages $message): static
    {
        if (!$this->message->contains($message)) {
            $this->message->add($message);
            $message->setCars($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): static
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getCars() === $this) {
                $message->setCars(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName().' ('.$this->getId().')';
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
}
