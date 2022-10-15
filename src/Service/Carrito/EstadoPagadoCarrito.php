<?php

namespace App\Service\Carrito;

use App\Entity\Carrito;
use App\Entity\Orden;
use App\Repository\CarritoRepository;

class EstadoPagadoCarrito
{
    public function __construct(
        private readonly CarritoRepository $carritoRepository,
    )
    {

    }

    public function pagadoOrden(Orden $orden):void
    {
        $carrito=$this->carritoRepository->findOneBy([
            'orden'=>$orden,
        ]);
        $carrito->setPagado((true));
        $this->carritoRepository->save($carrito,true);


    }
}