<?php

namespace App\Entity;

use App\Repository\Report4Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Report4Repository::class)]
class Report4
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
    private $year;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $gender;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $age1;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $age2;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $age3;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $age4;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $age5;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $age6;

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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

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

    public function getAge4(): ?string
    {
        return $this->age4;
    }

    public function setAge4(string $age4): self
    {
        $this->age4 = $age4;

        return $this;
    }

    public function getAge5(): ?string
    {
        return $this->age5;
    }

    public function setAge5(string $age5): self
    {
        $this->age5 = $age5;

        return $this;
    }

    public function getAge6(): ?string
    {
        return $this->age6;
    }

    public function setAge6(string $age6): self
    {
        $this->age6 = $age6;

        return $this;
    }
}
