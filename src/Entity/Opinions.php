<?php

namespace App\Entity;

use App\Entity\Traits\HasContentTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasIsApprovedTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\OpinionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: OpinionsRepository::class)]
class Opinions
{
    use HasIdTrait;
    use HasNameTrait;
    use HasContentTrait;
    use HasIsApprovedTrait;
    use TimestampableEntity;

    #[ORM\Column]
    private ?int $mark = null;

    #[ORM\ManyToOne(inversedBy: 'hasOpinions')]
    private ?Users $users = null;

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): static
    {
        $this->mark = $mark;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }
}
