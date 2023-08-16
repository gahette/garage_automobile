<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasLastnameTrait
{
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }
}
