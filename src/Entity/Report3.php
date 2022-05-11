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
    private $Year;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age1;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age2;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age3;

    #[ORM\Column(type: 'string', length: 255)]
    private $Born1;

    #[ORM\Column(type: 'string', length: 255)]
    private $Born2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->Year;
    }

    public function setYear(string $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getAge1(): ?string
    {
        return $this->Age1;
    }

    public function setAge1(string $Age1): self
    {
        $this->Age1 = $Age1;

        return $this;
    }

    public function getAge2(): ?string
    {
        return $this->Age2;
    }

    public function setAge2(string $Age2): self
    {
        $this->Age2 = $Age2;

        return $this;
    }

    public function getAge3(): ?string
    {
        return $this->Age3;
    }

    public function setAge3(string $Age3): self
    {
        $this->Age3 = $Age3;

        return $this;
    }

    public function getBorn1(): ?string
    {
        return $this->Born1;
    }

    public function setBorn1(string $Born1): self
    {
        $this->Born1 = $Born1;

        return $this;
    }

    public function getBorn2(): ?string
    {
        return $this->Born2;
    }

    public function setBorn2(string $Born2): self
    {
        $this->Born2 = $Born2;

        return $this;
    }
}
