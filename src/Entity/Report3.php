<?php

namespace App\Entity;

use App\Repository\Report3Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Report3Repository::class)]
class Report3
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $year;

    #[ORM\Column(type: 'string', length: 255)]
    private $age1;

    #[ORM\Column(type: 'string', length: 255)]
    private $age2;

    #[ORM\Column(type: 'string', length: 255)]
    private $age3;

    #[ORM\Column(type: 'string', length: 255)]
    private $born1;

    #[ORM\Column(type: 'string', length: 255)]
    private $born2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getAge1(): ?string
    {
        return $this->age1;
    }

    public function setAge1(string $age1): self
    {
        $this->age1 = $age1;

        return $this;
    }

    public function getAge2(): ?string
    {
        return $this->age2;
    }

    public function setAge2(string $age2): self
    {
        $this->age2 = $age2;

        return $this;
    }

    public function getAge3(): ?string
    {
        return $this->age3;
    }

    public function setAge3(string $age3): self
    {
        $this->age3 = $age3;

        return $this;
    }

    public function getBorn1(): ?string
    {
        return $this->born1;
    }

    public function setBorn1(string $born1): self
    {
        $this->born1 = $born1;

        return $this;
    }

    public function getBorn2(): ?string
    {
        return $this->born2;
    }

    public function setBorn2(string $born2): self
    {
        $this->born2 = $born2;

        return $this;
    }
}
