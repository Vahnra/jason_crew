<?php

namespace App\Controller;

use App\Entity\JasonCrew;
use App\Form\CrewFormType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default_home', methods:['GET', 'POST'])]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(CrewFormType::class)->handleRequest($request);

        $currentCrew = $entityManager->getRepository(JasonCrew::class)->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

            $jasonCrew = new JasonCrew;
            $jasonCrew->setName($form->get('name')->getData());

            if ($form->get('name')->getData() == "Jason") {
                $jasonCrew->setName('Jason, beau, vaillant et courageux');
            }

            if ($form->get('name')->getData() == "Orn") {
                $jasonCrew->setName('Orn, chanceux');
            }

            $jasonCrew->setCreatedAt(new DateTime());

            $entityManager->persist($jasonCrew);
            $entityManager->flush();

            return $this->redirectToRoute('default_home');
            
        }

        return $this->render('default/index.html.twig', [
          'form' => $form->createView(),
          'currentCrew' => $currentCrew
        ]);
    }

    #[Route('/delete-{id}', name: 'delete_crew', methods:['GET'])]
    public function deleteCrew(JasonCrew $jasonCrew, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($jasonCrew);
        $entityManager->flush();

        return $this->redirectToRoute('default_home');
    }
}
