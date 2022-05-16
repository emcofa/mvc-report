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
    private $year;

    #[ORM\Column(type: 'string', length: 255)]
    private $women;

    #[ORM\Column(type: 'string', length: 255)]
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

    public function getWomen(): ?string
    {
        return $this->women;
    }

    public function setWomen(string $women): self
    {
        $this->women = $women;

        return $this;
    }

    public function getMen(): ?string
    {
        return $this->men;
    }

    public function setMen(string $men): self
    {
        $this->men = $men;

        return $this;
    }
}
