<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $year;

    #[ORM\Column(type: 'float')]
    private $women;

    #[ORM\Column(type: 'float')]
    private $men;

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

    public function getWomen(): ?float
    {
        return $this->women;
    }

    public function setWomen(float $women): self
    {
        $this->women = $women;

        return $this;
    }

    public function getMen(): ?float
    {
        return $this->men;
    }

    public function setMen(float $men): self
    {
        $this->men = $men;

        return $this;
    }
}
