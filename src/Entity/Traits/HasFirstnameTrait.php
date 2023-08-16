<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasFirstnameTrait
{
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }
}
