<?php

namespace App\Controller;

use App\Entity\Seance;
use App\Form\SeanceFormType;
use App\Repository\PhotoRepository;
use App\Repository\SeanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SeanceController extends AbstractController
{
    #[Route('/seance', name: 'list_seance')]
    public function listSeances(SeanceRepository $seanceRepository, Security $security): Response
    {
        // Récupère l'utilisateur connecté via le service Security
        $user = $security->getUser();

        // Récupère les séances de cet utilisateur
        $seances = $seanceRepository->findBy(['user' => $user]);

        return $this->render('seance/list.html.twig', [
            'seances' => $seances,
        ]);
    }

    // Méthode détail d'une séance
    #[Route('/seance/{id}', name: 'detail_seance')]
    public function detailSeance($id, SeanceRepository $seanceRepository, PhotoRepository $photoRepository, Security $security): Response
    {
        // Récupère l'utilisateur connecté via le service Security
        $user = $security->getUser();

        // Récupère les séances de cet utilisateur
        $seance = $seanceRepository->findOneBy(['id' => $id, 'user' => $user]);

        return $this->render('seance/detail.html.twig', [
            'seance' => $seance,
        ]);
    }


    // Méthode d'ajout de séance
    #[Route('/seance/new', name: 'new_seance')]
    public function newSeance(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        // Crée une nouvelle Seance
        $seance = new Seance();

        // Crée le formulaire
        $form = $this->createForm(SeanceFormType::class, $seance);

        // Gère la requête du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Associe l'utilisateur connecté à la séance
            $user = $security->getUser();
            $seance->setUser($user);

            // Sauvegarde la séance dans la base de données
            $entityManager->persist($seance);
            $entityManager->flush();

            // Redirige l'utilisateur 
            return $this->redirectToRoute('list_seance'); 
        }

        // Rendre la vue avec le formulaire
        return $this->render('seance/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}