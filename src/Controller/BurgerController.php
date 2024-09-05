<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/burger', name: 'burger_')]
class BurgerController extends AbstractController
{
    #[Route('/liste', name: 'liste')]
    public function list(): Response {
        return $this->render('burgers_list.html.twig');
    }

    #[Route('/{id}', name: 'details')]
    public function show(int $id): Response {
        $burgers = [['id'=> '0', 'name' => 'cheeseburger', 'description' => 'burger avec du fromage'], ['id'=> '1', 'name' => 'chikenCrusty', 'description' => 'burger au poulet croustillant']];
        try {
            $burger = $burgers[$id];
            
        } catch (\Exception $e) {
            $burger = null;
        }
        return $this->render('burgers_details.html.twig', ['burger' => $burger]);
    }
}