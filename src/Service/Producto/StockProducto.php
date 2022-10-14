<?php

namespace App\Service\Producto;

use App\Repository\ProductoRepository;
use App\Entity\Orden;

class StockProducto
{
    public function __construct(
        private readonly ProductoRepository $productoRepository
    ){

    }
    public function verificarOrden(Orden $orden):bool
    {
        foreach ($orden->getDetalles() as $ordenDetalle){
            $producto =$this->productoRepository->find($ordenDetalle->getProducto()->getId());
            if($producto->getStock()<$ordenDetalle->getCantidad()){
                return false;
            }
        }
        return true;


    }
    public function actualizarProducto(Orden $orden):void{

        foreach ($orden->getDetalles() as $ordenDetalle){
            $producto =$this->productoRepository->find($ordenDetalle->getProducto()->getId());
            $stockNuevo=$producto->getStock()-$ordenDetalle->getCantidad();
            $producto->setStock($stockNuevo);
            $this->productoRepository->save($producto,true);

            }
        }




}