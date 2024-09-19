<?php

namespace App\Controller;

use App\Entity\Oignon;
use App\Form\OignonType;
use App\Repository\OignonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/oignon', name: 'oignon_')]
class OignonController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(OignonRepository $oignonRepository): Response
    {
        $oignons = $oignonRepository->findAll();

        return $this->render('oignon/index.html.twig', [
            'oignons' => $oignons,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $oignon = new Oignon();
        $form = $this->createForm(OignonType::class, $oignon);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($oignon);
            $entityManager->flush();

            return $this->redirectToRoute('oignon_index');
        }

        return $this->render('oignon/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
