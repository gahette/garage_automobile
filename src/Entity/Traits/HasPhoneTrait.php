<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasPhoneTrait
{
    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }
}
