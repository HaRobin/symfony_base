<?php

namespace App\Controller;

use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;
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
    
    #[Route('/create', name: 'create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $burger = new Burger();
        $burger->setName('Krabby Patty');
        $burger->setPrice(4.99);
     
        // Persister et sauvegarder le nouveau burger
        $entityManager->persist($burger);
        $entityManager->flush();
     
        return new Response('Burger créé avec succès !');
    }

    #[Route('/expensive', name:'expensive')]
    public function expensive(BurgerRepository $burgerRepository, Request $request): Response {
        $burgers = $burgerRepository->findByExpensive($request->query->get('limit') ?? 5);

        return $this->render('burger/expensive.html.twig', [
            'burgers' => $burgers,
            'limit' => $request->query->get('limit')
        ]);
    }

    #[Route('/{id}', name: 'details')]
    public function show(int $id, BurgerRepository $burgerRepository): Response {
        $burger = $burgerRepository->find($id);
        return $this->render('burger/details.html.twig', ['burger' => $burger]);
    }
}