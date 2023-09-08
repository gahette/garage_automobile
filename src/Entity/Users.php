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
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource]
#[get]
#[Patch]
#[Delete]
#[GetCollection]
#[Post]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    use HasIdTrait;
    use HasLastnameTrait;
    use HasFirstnameTrait;
    use HasEmailTrait;

    /**
     * @var array<mixed>
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string|null The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Opinions>
     */
    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Opinions::class)]
    private Collection $hasOpinions;

    /**
     * @var Collection<int, Messages>
     */
    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Messages::class)]
    private Collection $hasMessages;

    public function __construct()
    {
        $this->hasOpinions = new ArrayCollection();
        $this->hasMessages = new ArrayCollection();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return array<mixed>
     *
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array<mixed> $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Opinions>
     */
    public function getHasOpinions(): Collection
    {
        return $this->hasOpinions;
    }

    public function addHasOpinion(Opinions $hasOpinion): static
    {
        if (!$this->hasOpinions->contains($hasOpinion)) {
            $this->hasOpinions->add($hasOpinion);
            $hasOpinion->setUsers($this);
        }

        return $this;
    }

    public function removeHasOpinion(Opinions $hasOpinion): static
    {
        if ($this->hasOpinions->removeElement($hasOpinion)) {
            // set the owning side to null (unless already changed)
            if ($hasOpinion->getUsers() === $this) {
                $hasOpinion->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getHasMessages(): Collection
    {
        return $this->hasMessages;
    }

    public function addHasMessage(Messages $hasMessage): static
    {
        if (!$this->hasMessages->contains($hasMessage)) {
            $this->hasMessages->add($hasMessage);
            $hasMessage->setUsers($this);
        }

        return $this;
    }

    public function removeHasMessage(Messages $hasMessage): static
    {
        if ($this->hasMessages->removeElement($hasMessage)) {
            // set the owning side to null (unless already changed)
            if ($hasMessage->getUsers() === $this) {
                $hasMessage->setUsers(null);
            }
        }

        return $this;
    }
}
