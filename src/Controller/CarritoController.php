<?php

namespace App\Controller;

use App\Entity\Carrito;
use App\Form\CarritoType;
use App\Repository\CarritoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carrito')]
class CarritoController extends AbstractController
{
    #[Route('/', name: 'app_carrito_index', methods: ['GET'])]
    public function index(CarritoRepository $carritoRepository): Response
    {
        return $this->render('carrito/index.html.twig', [
            'carritos' => $carritoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_carrito_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarritoRepository $carritoRepository): Response
    {
        $carrito = new Carrito();
        $form = $this->createForm(CarritoType::class, $carrito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carritoRepository->save($carrito, true);

            return $this->redirectToRoute('app_carrito_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('carrito/new.html.twig', [
            'carrito' => $carrito,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carrito_show', methods: ['GET'])]
    public function show(Carrito $carrito): Response
    {
        return $this->render('carrito/show.html.twig', [
            'carrito' => $carrito,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_carrito_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carrito $carrito, CarritoRepository $carritoRepository): Response
    {
        $form = $this->createForm(CarritoType::class, $carrito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carritoRepository->save($carrito, true);

            return $this->redirectToRoute('app_carrito_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('carrito/edit.html.twig', [
            'carrito' => $carrito,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carrito_delete', methods: ['POST'])]
    public function delete(Request $request, Carrito $carrito, CarritoRepository $carritoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carrito->getId(), $request->request->get('_token'))) {
            $carritoRepository->remove($carrito, true);
        }

        return $this->redirectToRoute('app_carrito_index', [], Response::HTTP_SEE_OTHER);
    }
}
