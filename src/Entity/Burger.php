<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;


    #[ORM\ManyToOne(targetEntity: Pain::class)]
    private $pain;

    #[ORM\ManyToOne(targetEntity: Oignon::class)]
    private $oignon;

    #[ORM\ManyToMany(targetEntity: Sauce::class)]
    private $sauces;

    #[ORM\OneToOne(targetEntity: Image::class)]
    private $image;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burger')]
    private $commentaires;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPain(): ?Pain
    {
        return $this->pain;
    }

    public function setPain(?Pain $pain): static
    {
        $this->pain = $pain;

        return $this;
    }

    public function getOignon(): ?Oignon
    {
        return $this->oignon;
    }

    public function setOignon(?Oignon $oignon): static
    {
        $this->oignon = $oignon;

        return $this;
    }

    public function getSauces(): ?Sauce
    {
        return $this->sauces;
    }

    public function setSauces(?Sauce $sauces): static
    {
        $this->sauces = $sauces;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }
}
