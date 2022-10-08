<?php

namespace App\Entity;

use App\Repository\CarritoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarritoRepository::class)]
class Carrito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private ?string $precioTotal = null;

    #[ORM\OneToMany(mappedBy: 'carrito', targetEntity: CarritoDetalle::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $detalles;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cliente $cliente = null;

    

    public function __construct()
    {
        $this->detalles = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecioTotal(): ?string
    {
        return $this->precioTotal;
    }

    public function setPrecioTotal(string $precioTotal): self
    {
        $this->precioTotal = $precioTotal;

        return $this;
    }

    /**
     * @return Collection<int, CarritoDetalle>
     */
    public function getDetalles(): Collection
    {
        return $this->detalles;
    }

    public function addDetalle(CarritoDetalle $detalle): self
    {
        if (!$this->detalles->contains($detalle)) {
            $this->detalles->add($detalle);
            $detalle->setCarrito($this);
        }

        return $this;
    }

    public function removeDetalle(CarritoDetalle $detalle): self
    {
        if ($this->detalles->removeElement($detalle)) {
            // set the owning side to null (unless already changed)
            if ($detalle->getCarrito() === $this) {
                $detalle->setCarrito(null);
            }
        }

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }



}
