<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    
    // une constante ne peut pas être modifiée et est liée à la classe et non à l'objet
    const NORMAL="normal";
    const SPECIAL="special";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Beer::class, inversedBy="categories")
     */
    private $beers;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $term;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
        $this->setTerm(self::NORMAL); // self permet d'accèder à la constante de la classe
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Beer[]
     */
    public function getBeers(): Collection
    {
        return $this->beers;
    }

    public function addBeer(Beer $beer): self
    {
        if (!$this->beers->contains($beer)) {
            $this->beers[] = $beer;
        }

        return $this;
    }

    public function removeBeer(Beer $beer): self
    {
        $this->beers->removeElement($beer);

        return $this;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(?string $term): self
    {
        if(!in_array($term, [self::NORMAL, self::SPECIAL])){
            // On lance une exception ce qui provoque l'arrêt des scripts 

            throw new \InvalidArgumentException("Invalid term");
        }

        $this->term = $term;

        return $this;
    }
}
