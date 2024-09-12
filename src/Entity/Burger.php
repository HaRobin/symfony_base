<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection
     */
    #[ORM\ManyToMany(targetEntity: Sauce::class)]
    private $sauces;

    #[ORM\OneToOne(targetEntity: Image::class)]
    private $image;

    /**
     * @var Collection
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burger')]
    private $commentaires;

    public function __construct()
    {
        $this->sauces = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

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
        $pain->addBurger($this);

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

    public function getSauces(): ?ArrayCollection
    {
        return $this->sauces;
    }

    public function setSauces(?ArrayCollection $sauces): static
    {
        $this->sauces = $sauces;

        return $this;
    }

    public function addSauce(Sauce $sauce): static
    {
        if ($this->sauces->contains($sauce)) {
            return $this;
        }
        $this->sauces[] = $sauce;
        $sauce->addBurger($this);
        return $this;
    }

    public function removeSauce(Sauce $sauce): static
    {
        $this->sauces->removeElement($sauce);
        $sauce->removeBurger($this);
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

    public function getCommentaires(): ?ArrayCollection
    {
        return $this->commentaires;
    }

    public function setCommentaires(?ArrayCollection $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->contains($commentaire)) {
            return $this;
        }
        $this->commentaires[] = $commentaire;
        $commentaire->setBurger($this);
        return $this;
    }
}
