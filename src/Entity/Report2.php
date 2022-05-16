<?php

namespace App\Entity;

use App\Repository\Report2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Report2Repository::class)]
class Report2
{
    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $area;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $year1;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $year2;

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
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getYear1(): ?string
    {
        return $this->year1;
    }

    public function setYear1(string $year1): self
    {
        $this->year1 = $year1;

        return $this;
    }

    public function getYear2(): ?string
    {
        return $this->year2;
    }

    public function setYear2(string $year2): self
    {
        $this->year2 = $year2;

        return $this;
    }
}
