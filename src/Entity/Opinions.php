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
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\OpinionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OpinionsRepository::class)]
#[ApiResource]
#[get]
#[Patch(security: "is_granted('ROLE_EMPLOYEES')")]
#[Delete(security: "is_granted('ROLE_EMPLOYEES')")]
#[GetCollection]
#[Post]
class Opinions
{
    use HasIdTrait;
    //    use HasNameTrait;
    use HasContentTrait;

    //    use HasIsApprovedTrait;
    use HasTimestampTrait;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    #[ORM\Column]
    #[Groups(['get'])]
    private ?bool $is_approved = null;

    #[ORM\Column]
    #[Groups(['get'])]
    private ?int $mark = null;

    //    #[ORM\ManyToOne(inversedBy: 'hasOpinions')]
    //    #[Groups(['get'])]
    //    private ?Users $users = null;

    public function IsIsApproved(): ?bool
    {
        return $this->is_approved;
        //        return (null === $this->users) ? false : $this->is_approved;
    }

    public function setIsApproved(bool $is_approved): static
    {
        $this->is_approved = $is_approved;

        return $this;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): static
    {
        $this->mark = $mark;

        return $this;
    }

    //    public function getUsers(): ?Users
    //    {
    //        return $this->users;
    //    }
    //
    //    public function setUsers(?Users $users): static
    //    {
    //        $this->users = $users;
    //
    //        return $this;
    //    }
}
