<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Entity\Traits\HasIdTrait;
use App\Repository\OpeningHoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
#[ApiResource]
#[get]
#[Patch(security: "is_granted('ROLE_ADMIN')")]
#[Delete(security: "is_granted('ROLE_ADMIN')")]
#[GetCollection]
#[Post(security: "is_granted('ROLE_ADMIN')")]
class OpeningHours
{
    use HasIdTrait;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get'])]
    private ?string $day = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get'])]
    private ?string $amOpenHours = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get'])]
    private ?string $amCloseHours = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get'])]
    private ?string $pmOpenHours = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get'])]
    private ?string $pmCloseHours = null;

    #[ORM\ManyToOne(inversedBy: 'hasOpeningHours')]
    #[Groups(['get'])]
    private ?Garage $garage = null;

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getAmOpenHours(): ?string
    {
        return null !== $this->amOpenHours ? $this->amOpenHours : '';
    }

    public function setAmOpenHours(string $amOpenHours): static
    {
        $this->amOpenHours = $amOpenHours;

        return $this;
    }

    public function getAmCloseHours(): ?string
    {
        return null !== $this->amCloseHours ? $this->amCloseHours : '';
    }

    public function setAmCloseHours(string $amCloseHours): static
    {
        $this->amCloseHours = $amCloseHours;

        return $this;
    }

    public function getPmOpenHours(): ?string
    {
        //        return $this->pmOpenHours;
        return null !== $this->pmOpenHours ? $this->pmOpenHours : '';
    }

    public function setPmOpenHours(string $pmOpenHours): static
    {
        $this->pmOpenHours = $pmOpenHours;

        return $this;
    }

    public function getPmCloseHours(): ?string
    {
        return null !== $this->pmCloseHours ? $this->pmCloseHours : '';
    }

    public function setPmCloseHours(string $pmCloseHours): static
    {
        $this->pmCloseHours = $pmCloseHours;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): static
    {
        $this->garage = $garage;

        return $this;
    }
}
