<?php

declare(strict_types=1);

namespace App\Service\Orden;

use App\Entity\Carrito;
use App\Entity\Orden;
use App\Entity\OrdenDetalle;

final class ClonarCarritoOrden
{
    public function execute(Orden $orden, Carrito $carrito): void
    {
        $orden->setFecha(new \DateTime());
        $orden->setPrecioTotal($carrito->getPrecioTotal());
        $orden->setCliente($carrito->getCliente());

        foreach ($carrito->getDetalles() as $carritoDetalle) {
            $ordenDetalle = new OrdenDetalle();
            $ordenDetalle->setProducto($carritoDetalle->getProducto());
            $ordenDetalle->setCantidad($carritoDetalle->getCantidad());

            $orden->addDetalle($ordenDetalle);
        }

        $carrito->setOrden($orden);
    }
}
