<?php

namespace App\Controller;

use App\Repository\ActuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActusController extends AbstractController
{
    #[Route('/actus/{year?}', name: 'app_actus', methods: ['GET'])]
    public function index(?int $year, ActuRepository $repository): Response
    {
        $years = $repository->getAllYears();
        if ($year == null)
            $year = $years[0];
        $actus = $repository->findByYear($year);

        if (in_array($year, $years)) {
            return $this->render('pages/actus.html.twig', [
                'year' => $year,
                'years' => $years,
                'actus' => $actus,
            ]);
        } else {
            return $this->render('components/error.html.twig', [
               'error' => "L'année " . $year . " n'existe pas dans les données. " . implode(" ", $years),
            ]);
        }
    }

}
