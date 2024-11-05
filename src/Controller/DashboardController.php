<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {

        // Récupère l'utilisateur connecté
        /** @var User $user */
        $user = $this->getUser();


        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
        ]);
    }
}
