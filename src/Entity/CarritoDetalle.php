<?php

namespace App\Entity;

use App\Repository\CarritoDetalleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarritoDetalleRepository::class)]
class CarritoDetalle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producto $Producto = null;

    #[ORM\Column]
    private ?int $Cantidad = null;

    #[ORM\ManyToOne(inversedBy: 'detalles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carrito $carrito = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducto(): ?Producto
    {
        return $this->Producto;
    }

    public function setProducto(?Producto $Producto): self
    {
        $this->Producto = $Producto;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->Cantidad;
    }

    public function setCantidad(int $Cantidad): self
    {
        $this->Cantidad = $Cantidad;

        return $this;
    }

    public function getCarrito(): ?Carrito
    {
        return $this->carrito;
    }

    public function setCarrito(?Carrito $carrito): self
    {
        $this->carrito = $carrito;

        return $this;
    }


}
