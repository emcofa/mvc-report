<?php

namespace App\Entity;

use App\Repository\Report2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Report2Repository::class)]
class Report2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $area;

    #[ORM\Column(type: 'string', length: 255)]
    private $Type;

    #[ORM\Column(type: 'string', length: 255)]
    private $Year1;

    #[ORM\Column(type: 'string', length: 255)]
    private $Year2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getYear1(): ?string
    {
        return $this->Year1;
    }

    public function setYear1(string $Year1): self
    {
        $this->Year1 = $Year1;

        return $this;
    }

    public function getYear2(): ?string
    {
        return $this->Year2;
    }

    public function setYear2(string $Year2): self
    {
        $this->Year2 = $Year2;

        return $this;
    }
}
