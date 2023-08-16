<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\OpeningHoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
class OpeningHours
{
    use HasIdTrait;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\Column(length: 255)]
    private ?string $amOpenHours = null;

    #[ORM\Column(length: 255)]
    private ?string $amCloseHours = null;

    #[ORM\Column(length: 255)]
    private ?string $pmOpenHours = null;

    #[ORM\Column(length: 255)]
    private ?string $pmCloseHours = null;

    #[ORM\ManyToOne(inversedBy: 'hasOpeningHours')]
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