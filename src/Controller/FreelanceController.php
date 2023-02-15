<?php

namespace App\Controller;

use App\Entity\Freelance;

use App\Form\FreelanceType;
use App\Repository\FreelanceRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/freelance')]
class FreelanceController extends AbstractController
{
    #[Route('/', name: 'app_freelance_index', methods: ['GET'])]
    public function index(FreelanceRepository $freelanceRepository): Response
    {
        return $this->render('freelance/index.html.twig', [
            'freelances' => $freelanceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_freelance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FreelanceRepository $freelanceRepository, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {

        $freelance = new Freelance();

        $form = $this->createForm(FreelanceType::class, $freelance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $freelance->setUser($this->getUser());
            $photoFile = $form->get('photo')->getData();
            $portfolioFile = $form->get('portfolio')->getData();
            // $freelanceRepository->save($freelance, true);

            if ($photoFile) {
            $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $photoFile->move(
                    $this->getParameter('photo_free'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            // updates the 'brochureFilename' property to store the JPG/PNG file name
            // instead of its contents

            $freelance->setPhoto($newFilename);
            }

            if ($portfolioFile) {
                $originalFilename = pathinfo($portfolioFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$portfolioFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $portfolioFile->move(
                        $this->getParameter('portfolio_free'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                // updates the 'brochureFilename' property to store the JPG file name
                // instead of its contents
                $freelance->setPortfolio($newFilename);
            }
            $entityManager->persist($freelance);
            $entityManager->flush();

            return $this->redirectToRoute('app_freelance_index');
        }

        return $this->render('freelance/new.html.twig', [
            'freelance' => $freelance,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_freelance_show', methods: ['GET'])]
    public function show(Freelance $freelance): Response
    {
        return $this->render('freelance/show.html.twig', [
            'freelance' => $freelance,
        ]);
    }

//    #[NoReturn]
//    public function temporaryUploadAction(Request $request)
//    {
//        /** @var UploadedFile $uploadedFile */
//        $uploadedFile = $request->files->get('image');
//        $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
//
//        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
//        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
//
//        dd($uploadedFile->move(
//            $destination,
//            $newFilename
//        ));
//    }

    #[Route('/{id}/edit', name: 'app_freelance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Freelance $freelance, FreelanceRepository $freelanceRepository, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $formedit = $this->createForm(FreelanceType::class, $freelance);
        $formedit->handleRequest($request);

        if ($formedit->isSubmitted() && $formedit->isValid()) {
            $photoFile = $formedit->get('photo')->getData();
            $portfolioFile = $formedit->get('portfolio')->getData();
            // $freelanceRepository->save($freelance, true);

            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photoFile->move(
                        $this->getParameter('photo_free'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                // updates the 'brochureFilename' property to store the JPG/PNG file name
                // instead of its contents

                $freelance->setPhoto($newFilename);
            }

            if ($portfolioFile) {
                $originalFilename = pathinfo($portfolioFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$portfolioFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $portfolioFile->move(
                        $this->getParameter('portfolio_free'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                // updates the 'brochureFilename' property to store the JPG file name
                // instead of its contents
                $freelance->setPortfolio($newFilename);
            }
            $entityManager->persist($freelance);
            $entityManager->flush();

            return $this->redirectToRoute('app_freelance_index');
        }

        return $this->renderForm('freelance/edit.html.twig', [
            'freelance' => $freelance,
            'form' => $formedit,
        ]);
    }

    #[Route('/{id}', name: 'app_freelance_delete', methods: ['POST'])]
    public function delete(Request $request, Freelance $freelance, FreelanceRepository $freelanceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$freelance->getId(), $request->request->get('_token'))) {
            $freelanceRepository->remove($freelance, true);
        }

        return $this->redirectToRoute('app_freelance_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/portfolio/{id}', name: 'app_portfolio', methods: ['GET'])]
    public function portfolio(Freelance $freelance): Response
    {

        return $this->render('freelance/portfolio.html.twig', [
            "freelance" => $freelance
        ]);
    }
}
