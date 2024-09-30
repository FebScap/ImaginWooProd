<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActusController extends AbstractController
{
    #[Route('/actus/{year?}', name: 'app_actus',  methods: ['GET'])]
    public function index(?int $year): Response
    {
        $years = [2021, 2022, 2023, 2024];
        if ($year == null) {
            $year = date('Y');
        } else if (!in_array($year, $years)) {
            return $this->render('erreur/index.html.twig', [
                'error' => "L'année : " . $year . " n'existe pas dans la base de donnée",
            ]);
        }
        return $this->render('actus/index.html.twig', [
            'year' => $year,
        ]);
    }

}
