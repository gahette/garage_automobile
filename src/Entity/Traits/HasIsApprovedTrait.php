<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasIsApprovedTrait
{
    #[ORM\Column]
    private ?bool $is_approved = null;

    public function isIsApproved(): ?bool
    {
        return $this->is_approved;
    }

    public function setIsApproved(bool $is_approved): static
    {
        $this->is_approved = $is_approved;

        return $this;
    }
}
