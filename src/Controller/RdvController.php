<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RdvController extends AbstractController
{
    #[Route('/rdv', name: 'rdv.index')]
    public function index(): Response
    {
        return $this->render(view: 'rdv.html.twig');
    }
}
