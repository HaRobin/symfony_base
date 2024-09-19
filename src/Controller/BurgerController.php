<?php

namespace App\Controller;

use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;
use App\Form\BurgerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/burger', name: 'burger_')]
class BurgerController extends AbstractController {

    #[Route('/', name: 'index')]
    public function index(BurgerRepository $burgerRepository, Request $request): Response {
        $burgers = $burgerRepository->findByIngredient($request->query->get('ingredient') ?? '');

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers, 
            'ingredient' => $request->query->get('ingredient')
        ]);
    }
    
    
    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($burger);
            $entityManager->flush();

            return $this->redirectToRoute('burger_index');
        }

        return $this->render('burger/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/expensive', name:'expensive')]
    public function expensive(BurgerRepository $burgerRepository, Request $request): Response {
        $burgers = $burgerRepository->findByExpensive($request->query->get('limit') ?? 5);

        return $this->render('burger/expensive.html.twig', [
            'burgers' => $burgers,
            'limit' => $request->query->get('limit')
        ]);
    }

    #[Route('/avoid', name:'avoid')]
    public function avoir(BurgerRepository $burgerRepository, Request $request): Response {
        $burgers = $burgerRepository->findByWithoutIngredient($request->query->get('ingredient') ?? 5);

        return $this->render('burger/avoid.html.twig', [
            'burgers' => $burgers,
            'ingredient' => $request->query->get('ingredient')
        ]);
    }

    #[Route('/amountsofingredients', name:'amountsofingredients')]
    public function amountsOfIngredients(BurgerRepository $burgerRepository, Request $request): Response {
        $burgers = $burgerRepository->findByAmountOfIngredients($request->query->get('amount') ?? 5);

        return $this->render('burger/amountsofingredients.html.twig', [
            'burgers' => $burgers,
            'amount' => $request->query->get('amount')
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function show(int $id, BurgerRepository $burgerRepository): Response {
        $burger = $burgerRepository->find($id);
        return $this->render('burger/details.html.twig', ['burger' => $burger]);
    }
}