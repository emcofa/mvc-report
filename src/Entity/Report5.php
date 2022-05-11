<?php

namespace App\Entity;

use App\Repository\Report5Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Report5Repository::class)]
class Report5
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Year;

    #[ORM\Column(type: 'string', length: 255)]
    private $Women;

    #[ORM\Column(type: 'string', length: 255)]
    private $Men;

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

    public function getWomen(): ?string
    {
        return $this->Women;
    }

    public function setWomen(string $Women): self
    {
        $this->Women = $Women;

        return $this;
    }

    public function getMen(): ?string
    {
        return $this->Men;
    }

    public function setMen(string $Men): self
    {
        $this->Men = $Men;

        return $this;
    }
}
