<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasEmailTrait
{
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
