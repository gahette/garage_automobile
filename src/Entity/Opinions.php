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
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\OpinionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OpinionsRepository::class)]
#[ApiResource]
#[get]
#[Patch]
#[Delete]
#[GetCollection]
#[Post]
class Opinions
{
    use HasIdTrait;
    use HasNameTrait;
    use HasContentTrait;
    use HasIsApprovedTrait;
    use HasTimestampTrait;

    #[ORM\Column]
    #[Groups(['get'])]
    private ?int $mark = null;

    #[ORM\ManyToOne(inversedBy: 'hasOpinions')]
    #[Groups(['get'])]
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
