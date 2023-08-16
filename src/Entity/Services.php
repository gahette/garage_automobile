<?php

namespace App\Entity;

use App\Entity\Traits\HasContentTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasIsApprovedTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasPriceTrait;
use App\Repository\ServicesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    use HasIdTrait;
    use HasNameTrait;
    use HasContentTrait;
    use HasIsApprovedTrait;
    use HasPriceTrait;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\ManyToOne(inversedBy: 'hasServices')]
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
