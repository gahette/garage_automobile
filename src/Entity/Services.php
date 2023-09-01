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
use App\Entity\Traits\HasIsApprovedTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasPriceTrait;
use App\Repository\ServicesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
#[ApiResource]
#[get]
#[Patch]
#[Delete]
#[GetCollection]
#[Post]
class Services
{
    use HasIdTrait;
    use HasNameTrait;
    use HasContentTrait;
    use HasIsApprovedTrait;
    use HasPriceTrait;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get'])]
    private ?string $category = null;

    #[ORM\ManyToOne(inversedBy: 'hasServices')]
    #[Groups(['get'])]
    private ?Garage $garage = null;

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

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
}
