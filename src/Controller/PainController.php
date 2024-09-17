<?php

namespace App\Controller;

use App\Repository\PainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PainController extends AbstractController
{
    #[Route('/pain', name: 'app_pain')]
    public function index(PainRepository $painRepository): Response {
        $pains = $painRepository->findAll();

        return $this->render('pain/index.html.twig', [
            'pains' => $pains,
        ]);
    }
}
