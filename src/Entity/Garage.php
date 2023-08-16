<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasPhoneTrait;
use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarageRepository::class)]
class Garage
{
    use HasIdTrait;
    use HasNameTrait;
    use HasPhoneTrait;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $zip_code = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Services::class)]
    private Collection $hasServices;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: OpeningHours::class)]
    private Collection $hasOpeningHours;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Cars::class)]
    private Collection $hasCars;

    public function __construct()
    {
        $this->hasServices = new ArrayCollection();
        $this->hasOpeningHours = new ArrayCollection();
        $this->hasCars = new ArrayCollection();
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): static
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getHasServices(): Collection
    {
        return $this->hasServices;
    }

    public function addHasService(Services $hasService): static
    {
        if (!$this->hasServices->contains($hasService)) {
            $this->hasServices->add($hasService);
            $hasService->setGarage($this);
        }

        return $this;
    }

    public function removeHasService(Services $hasService): static
    {
        if ($this->hasServices->removeElement($hasService)) {
            // set the owning side to null (unless already changed)
            if ($hasService->getGarage() === $this) {
                $hasService->setGarage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OpeningHours>
     */
    public function getHasOpeningHours(): Collection
    {
        return $this->hasOpeningHours;
    }

    public function addHasOpeningHour(OpeningHours $hasOpeningHour): static
    {
        if (!$this->hasOpeningHours->contains($hasOpeningHour)) {
            $this->hasOpeningHours->add($hasOpeningHour);
            $hasOpeningHour->setGarage($this);
        }

        return $this;
    }

    public function removeHasOpeningHour(OpeningHours $hasOpeningHour): static
    {
        if ($this->hasOpeningHours->removeElement($hasOpeningHour)) {
            // set the owning side to null (unless already changed)
            if ($hasOpeningHour->getGarage() === $this) {
                $hasOpeningHour->setGarage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cars>
     */
    public function getHasCars(): Collection
    {
        return $this->hasCars;
    }

    public function addHasCar(Cars $hasCar): static
    {
        if (!$this->hasCars->contains($hasCar)) {
            $this->hasCars->add($hasCar);
            $hasCar->setGarage($this);
        }

        return $this;
    }

    public function removeHasCar(Cars $hasCar): static
    {
        if ($this->hasCars->removeElement($hasCar)) {
            // set the owning side to null (unless already changed)
            if ($hasCar->getGarage() === $this) {
                $hasCar->setGarage(null);
            }
        }

        return $this;
    }
}