<?php

namespace App\Controller;

use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/burger', name: 'burger_')]
class BurgerController extends AbstractController {
    private array $burgers = [
        '0' => ['name' => 'cheeseburger', 'description' => 'burger avec du fromage'],
        '1' => ['name' => 'chikenCrusty', 'description' => 'burger au poulet croustillant']
    ];

    #[Route('/', name: 'index')]
    public function index(BurgerRepository $burgerRepository): Response {
        $burgers = $burgerRepository->findAll();

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/create', name: 'burger_create')]
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

    #[Route('/liste', name: 'list')]
    public function list(): Response {
        return $this->render('burger/list.html.twig', ['burgers' => $this->burgers]);
    }

    #[Route('/{id}', name: 'details')]
    public function show(int $id): Response {
        
        try {
            $burger = $this->burgers[$id] ?? null;
        } catch (\Exception $e) {
            $burger = null;
        }
        return $this->render('burger/details.html.twig', ['burger' => $burger]);
    }
}