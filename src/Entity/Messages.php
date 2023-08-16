<?php

namespace App\Entity;

use App\Entity\Traits\HasEmailTrait;
use App\Entity\Traits\HasFirstnameTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasLastnameTrait;
use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    use HasIdTrait;
    use HasLastnameTrait;
    use HasFirstnameTrait;
    use HasEmailTrait;
    use TimestampableEntity;

    #[ORM\ManyToOne(inversedBy: 'hasMessages')]
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
