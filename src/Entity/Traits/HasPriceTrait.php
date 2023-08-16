<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasPriceTrait
{
    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }
}
