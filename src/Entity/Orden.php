<?php

namespace App\Entity;

use App\Repository\OrdenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdenRepository::class)]
class Orden
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cliente $cliente = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private ?string $precioTotal = null;

    #[ORM\OneToMany(mappedBy: 'orden', targetEntity: OrdenDetalle::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $detalles;

    #[ORM\Column(length: 6, nullable: true)]
    private ?string $metodoPago = null;

    public function __construct()
    {
        $this->detalles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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
     * @return Collection<int, OrdenDetalle>
     */
    public function getDetalles(): Collection
    {
        return $this->detalles;
    }

    public function addDetalle(OrdenDetalle $detalle): self
    {
        if (!$this->detalles->contains($detalle)) {
            $this->detalles->add($detalle);
            $detalle->setOrden($this);
        }

        return $this;
    }

    public function removeDetalle(OrdenDetalle $detalle): self
    {
        if ($this->detalles->removeElement($detalle)) {
            // set the owning side to null (unless already changed)
            if ($detalle->getOrden() === $this) {
                $detalle->setOrden(null);
            }
        }

        return $this;
    }

    public function getMetodoPago(): ?string
    {
        return $this->metodoPago;
    }

    public function setMetodoPago(?string $metodoPago): self
    {
        $this->metodoPago = $metodoPago;

        return $this;
    }
}