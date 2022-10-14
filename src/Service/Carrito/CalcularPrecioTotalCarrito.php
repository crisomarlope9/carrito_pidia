<?php

namespace App\Service\Carrito;
use App\Entity\Carrito;

class CalcularPrecioTotalCarrito
{
    public function execute(Carrito $carrito): void
    {
        $total = 0.00;
        foreach ($carrito->getDetalles() as $carritoDetalle) {
            $precio = $carritoDetalle->getProducto()->getPrecio();
            $cantidad = $carritoDetalle->getCantidad();
            $costoTotal = $precio * $cantidad;
            $total += $costoTotal;
        }

        $carrito->setPrecioTotal((string) $total);
    }
}