<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
// use ApiPlatform\Metadata\Delete;
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
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('email')]
#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource]
#[get(security: "is_granted('ROLE_ADMIN') or object == user")]
#[Patch(security: "is_granted('ROLE_ADMIN')")]
#[Delete(security: "is_granted('ROLE_ADMIN')")]
#[GetCollection(security: "is_granted('ROLE_ADMIN')")]
#[Post(security: "is_granted('ROLE_ADMIN')")]
class Users implements UserInterface, PasswordAuthenticatedUserInterface, JWTUserInterface
{
    use HasIdTrait;
    use HasLastnameTrait;
    use HasFirstnameTrait;
    use HasEmailTrait;

    /**
     * @var array<mixed>
     */
    #[ORM\Column]
    #[Groups(['get'])]
    private array $roles = [];

    #[Assert\Length(min: 4)]
    private ?string $plainPassword = null;

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

    /**
     * @var Collection<int, Cars>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Cars::class, cascade: ['persist', 'remove'])]
    #[Groups(['User:item:get'])]
    private Collection $cars;

    public function __construct()
    {
        $this->hasOpinions = new ArrayCollection();
        $this->hasMessages = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
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
        $this->plainPassword = null;
    }

    public static function createFromPayload($username, array $payload): self
    {
        return (new self())
            ->setId($username)
            ->setRoles($payload['roles'])
            ->setEmail($payload['email'])
        ;
    }

//    /**
//     * @return Collection<int, Opinions>
//     */
//    public function getHasOpinions(): Collection
//    {
//        return $this->hasOpinions;
//    }
//
//    public function addHasOpinion(Opinions $hasOpinion): static
//    {
//        if (!$this->hasOpinions->contains($hasOpinion)) {
//            $this->hasOpinions->add($hasOpinion);
//            $hasOpinion->setUsers($this);
//        }
//
//        return $this;
//    }
//
//    public function removeHasOpinion(Opinions $hasOpinion): static
//    {
//        if ($this->hasOpinions->removeElement($hasOpinion)) {
//            // set the owning side to null (unless already changed)
//            if ($hasOpinion->getUsers() === $this) {
//                $hasOpinion->setUsers(null);
//            }
//        }
//
//        return $this;
//    }

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

    /**
     * @return Collection<int, Cars>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setUser($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getUser() === $this) {
                $car->setUser(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFirstname().' '.$this->getLastname();
    }
}
