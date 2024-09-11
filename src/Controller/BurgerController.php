<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/burger', name: 'burger_')]
class BurgerController extends AbstractController {
    private array $burgers = [
        '0' => ['name' => 'cheeseburger', 'description' => 'burger avec du fromage'],
        '1' => ['name' => 'chikenCrusty', 'description' => 'burger au poulet croustillant']
    ];

    #[Route('/liste', name: 'list')]
    public function list(): Response {
        return $this->render('burgers_list.html.twig', ['burgers' => $this->burgers]);
    }

    #[Route('/{id}', name: 'details')]
    public function show(int $id): Response {
        
        try {
            $burger = $this->burgers[$id] ?? null;
        } catch (\Exception $e) {
            $burger = null;
        }
        return $this->render('burgers_details.html.twig', ['burger' => $burger]);
    }
}