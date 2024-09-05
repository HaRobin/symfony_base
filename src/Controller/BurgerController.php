<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/burger', name: 'burger_')]
class BurgerController extends AbstractController
{
    #[Route('/liste', name: 'liste')]
    public function list(): Response
    {
        return $this->render('burgers_list.html.twig');
    }
}