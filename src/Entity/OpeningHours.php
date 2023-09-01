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
#[Patch]
#[Delete]
#[GetCollection]
#[Post]
class OpeningHours
{
    use HasIdTrait;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $day = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $amOpenHours = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $amCloseHours = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get'])]
    private ?string $pmOpenHours = null;

    #[ORM\Column(length: 255)]
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
        return $this->amOpenHours;
    }

    public function setAmOpenHours(string $amOpenHours): static
    {
        $this->amOpenHours = $amOpenHours;

        return $this;
    }

    public function getAmCloseHours(): ?string
    {
        return $this->amCloseHours;
    }

    public function setAmCloseHours(string $amCloseHours): static
    {
        $this->amCloseHours = $amCloseHours;

        return $this;
    }

    public function getPmOpenHours(): ?string
    {
        return $this->pmOpenHours;
    }

    public function setPmOpenHours(string $pmOpenHours): static
    {
        $this->pmOpenHours = $pmOpenHours;

        return $this;
    }

    public function getPmCloseHours(): ?string
    {
        return $this->pmCloseHours;
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
