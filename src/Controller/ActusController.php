<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActusController extends AbstractController
{
    #[Route('/actus/{year}', name: 'app_actus',  methods: ['GET'])]
    public function index(int $year): Response
    {
        return $this->render('actus/index.html.twig', [
            'year' => $year,
        ]);
    }

}
