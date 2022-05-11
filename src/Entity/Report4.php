<?php

namespace App\Entity;

use App\Repository\Report4Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Report4Repository::class)]
class Report4
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Year;

    #[ORM\Column(type: 'string', length: 255)]
    private $Gender;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age1;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age2;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age3;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age4;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age5;

    #[ORM\Column(type: 'string', length: 255)]
    private $Age6;

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

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

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

    public function getAge4(): ?string
    {
        return $this->Age4;
    }

    public function setAge4(string $Age4): self
    {
        $this->Age4 = $Age4;

        return $this;
    }

    public function getAge5(): ?string
    {
        return $this->Age5;
    }

    public function setAge5(string $Age5): self
    {
        $this->Age5 = $Age5;

        return $this;
    }

    public function getAge6(): ?string
    {
        return $this->Age6;
    }

    public function setAge6(string $Age6): self
    {
        $this->Age6 = $Age6;

        return $this;
    }
}
