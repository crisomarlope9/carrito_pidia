<?php

namespace App\Controller;

use App\Entity\Carrito;
use App\Entity\Orden;
use App\Form\OrdenType;
use App\Repository\CarritoRepository;
use App\Repository\OrdenRepository;
use App\Service\Orden\ClonarCarritoOrden;
use App\Service\Producto\StockProducto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/orden')]
class OrdenController extends AbstractController
{
    #[Route('/', name: 'app_orden_index', methods: ['GET'])]
    public function index(OrdenRepository $ordenRepository): Response
    {
        return $this->render('orden/index.html.twig', [
            'ordens' => $ordenRepository->findAll(),
        ]);
    }

//    #[Route('/new', name: 'app_orden_new', methods: ['GET', 'POST'])]
//    public function new(Request $request, OrdenRepository $ordenRepository): Response
//    {
//        $orden = new Orden();
//        $form = $this->createForm(OrdenType::class, $orden);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $ordenRepository->save($orden, true);
//
//            return $this->redirectToRoute('app_orden_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('orden/new.html.twig', [
//            'orden' => $orden,
//            'form' => $form,
//        ]);
//    }

    #[Route('/{id}', name: 'app_orden_show', methods: ['GET'])]
    public function show(Orden $orden): Response
    {
        return $this->render('orden/show.html.twig', [
            'orden' => $orden,
        ]);
    }

    #[Route('/{id}/carrito', name: 'app_orden_carrito', methods: ['GET'])]
    public function addCarrito(
        Carrito $carrito,
        OrdenRepository $ordenRepository,
        ClonarCarritoOrden $clonarCarritoOrden,
        CarritoRepository $carritoRepository,
    ): Response {
        $orden = $carrito->getOrden();
        if (null === $orden) {
            $orden = new Orden();
            $clonarCarritoOrden->execute($orden, $carrito);
            $ordenRepository->save($orden, true);
            $carritoRepository->save($carrito, true);
        }

        return $this->redirectToRoute('app_orden_edit', ['id' => $orden->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/edit', name: 'app_orden_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Orden $orden, OrdenRepository $ordenRepository, StockProducto $stockProducto): Response
    {
        $form = $this->createForm(OrdenType::class, $orden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //verificar stock
            if(false === $stockProducto->verificarOrden($orden)){
                return $this->redirectToRoute('app_orden_edit', ['id' => $orden->getId()], Response::HTTP_SEE_OTHER);
            }
            $ordenRepository->save($orden, true);
            //moficar stock
            $stockProducto->actualizarProducto($orden);


            return $this->redirectToRoute('app_orden_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('orden/edit.html.twig', [
            'orden' => $orden,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_orden_delete', methods: ['POST'])]
    public function delete(Request $request, Orden $orden, OrdenRepository $ordenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orden->getId(), $request->request->get('_token'))) {
            $ordenRepository->remove($orden, true);
        }

        return $this->redirectToRoute('app_orden_index', [], Response::HTTP_SEE_OTHER);
    }
}
