<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\FreelanceRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FreelanceRepository $freelanceRepository)
    {
        return $this->render('home/index.html.twig', [
            'freelances' => $freelanceRepository->findAll(),
        ]);

    }
}
