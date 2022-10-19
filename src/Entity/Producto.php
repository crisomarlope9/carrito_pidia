<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use CarlosChininin\FileUpload\Model\FileUpload;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'],orphanRemoval:true)]
    private ?FileUpload $foto = null;


    #[ORM\ManyToMany(targetEntity: FileUpload::class,cascade: ['persist', 'remove'],orphanRemoval:true)]
    private Collection $imagenes;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marca $marca = null;

    #[ORM\ManyToOne(targetEntity: Categoria::class,inversedBy:'productos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categoria $categoria = null;



    public function __construct()
    {
        //$this->stock='0';
        $this->imagenes = new ArrayCollection();

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNombre();
    }

    public function getFoto(): ?FileUpload
    {
        return $this->foto;
    }

    public function setFoto(?FileUpload $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return Collection<int, FileUpload>
     */
    public function getImagenes(): Collection
    {
        return $this->imagenes;
    }

    public function addImagene(FileUpload $imagene): self
    {
        if (!$this->imagenes->contains($imagene)) {
            $this->imagenes->add($imagene);
        }

        return $this;
    }

    public function removeImagene(FileUpload $imagene): self
    {
        $this->imagenes->removeElement($imagene);

        return $this;
    }

    public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }


    





}
