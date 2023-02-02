<?php

namespace App\Controller;

use App\Entity\Freelance;
use App\Form\FreelanceType;
use App\Repository\FreelanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(Request $request, FreelanceRepository $freelanceRepository): Response
    {
        $freelance = new Freelance();
        $form = $this->createForm(FreelanceType::class, $freelance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $freelanceRepository->save($freelance, true);

            return $this->redirectToRoute('app_freelance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('freelance/new.html.twig', [
            'freelance' => $freelance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_freelance_show', methods: ['GET'])]
    public function show(Freelance $freelance): Response
    {
        return $this->render('freelance/show.html.twig', [
            'freelance' => $freelance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_freelance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Freelance $freelance, FreelanceRepository $freelanceRepository): Response
    {
        $form = $this->createForm(FreelanceType::class, $freelance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $freelanceRepository->save($freelance, true);

            return $this->redirectToRoute('app_freelance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('freelance/edit.html.twig', [
            'freelance' => $freelance,
            'form' => $form,
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
}
