<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpinionsController extends AbstractController
{
    #[Route('/opinions', name: 'opinions.index')]
    public function index(): Response
    {
        return $this->render('opinions.html.twig');
    }
}
