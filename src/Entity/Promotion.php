<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
    * @Assert\NotBlank(message="Please, enter a discount percent!")
    * @Assert\Range(min="1",max="99", minMessage="Please enter a positive number!", maxMessage="Promotion can't be larger than 99 percent!")
    */
    private $discount;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Please, enter a start date.")
     * @Assert\Date()
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Please, enter a start date.")
     * @Assert\Date()
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="promotions")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
