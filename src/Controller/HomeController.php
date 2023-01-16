<?php

namespace App\Controller;

use App\Entity\Product;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index()
    {
        return new Response(
            '<html>
                       <body>
                            <div>TEST</div>
                        </body>
            <html>'
        );
    }
}
