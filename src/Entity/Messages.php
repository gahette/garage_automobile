<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Entity\Traits\HasEmailTrait;
use App\Entity\Traits\HasFirstnameTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasLastnameTrait;
use App\Entity\Traits\HasTimestampTrait;
use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
#[ApiResource]
#[get]
#[Patch]
#[Delete]
#[GetCollection]
#[Post]
class Messages
{
    use HasIdTrait;
    use HasLastnameTrait;
    use HasFirstnameTrait;
    use HasEmailTrait;
    use HasTimestampTrait;

    #[ORM\ManyToOne(inversedBy: 'hasMessages')]
    #[Groups(['get'])]
    private ?Users $users = null;

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
