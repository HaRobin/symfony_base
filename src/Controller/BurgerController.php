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

    #[Route('/', name: 'index')]
    public function index(BurgerRepository $burgerRepository): Response {
        $burgers = $burgerRepository->findAll();

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);
    }
    #[Route('/{id}', name: 'details')]
    public function show(int $id, BurgerRepository $burgerRepository): Response {
        $burger = $burgerRepository->find($id);
        return $this->render('burger/details.html.twig', ['burger' => $burger]);
    }

    #[Route('/create', name: 'burger_create')]
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
}