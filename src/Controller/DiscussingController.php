<?php

namespace App\Controller;

use App\Entity\Discussing;
use App\Entity\Message;
use App\Form\DiscussingType;
use App\Form\MessageType;
use App\Repository\DiscussingRepository;
use App\Repository\FreelanceRepository;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

#[Route('/discussing')]
class DiscussingController extends AbstractController
{


    #[Route('/{id}', name: 'app_discussing_index', methods: ['GET'])]
    public function index(DiscussingRepository $discussingRepository, $id): Response
    {
        return $this->render('discussing/index.html.twig', [
            'discussings' => $discussingRepository->findAll(),
            'id' => $id,
        ]);
    }

    #[Route('/{id}/new', name: 'app_discussing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DiscussingRepository $discussingRepository,$id,FreelanceRepository $freelanceRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser());
        $freelance = $freelanceRepository->find($id);
        $discussing = new Discussing();
//        $discussing->setAuthor($user);
//        $discussing->Recipient($recipient);

        $form = $this->createForm(DiscussingType::class, $discussing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussing->setAuthor($user->getFirstname());
            $discussing->setRecipient($freelance->getUser()->getFirstname());
            $discussingRepository->save($discussing, true);

            return $this->redirectToRoute('app_discussing_index', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discussing/new.html.twig', [
            'discussing' => $discussing,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'app_discussing_show', methods: ['GET', 'POST'])]
    public function show($id, DiscussingRepository $discussingRepository, Request $request, MessageRepository $messageRepository): Response
    {
        $discussing = $discussingRepository->find($id);
//        $freelance = $freelanceRepository->find($id);
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() and  $form->isValid()){
            $message->setDiscussing($discussing);
            $message->setDate(new \DateTime('now'));
            $message->setMessage_author($this->getUser());
            $messageRepository->save($message, true);

            return $this->redirectToRoute('app_discussing_show', ['id' => $id]);
        }

        return $this->render('discussing/show.html.twig',['form' => $form->createView(),'discussing' => $discussing,]);
    }

    #[Route('/{id}/edit', name: 'app_discussing_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Discussing $discussing, DiscussingRepository $discussingRepository): Response
    {
        $form = $this->createForm(DiscussingType::class, $discussing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussingRepository->save($discussing, true);

            return $this->redirectToRoute('app_discussing_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discussing/edit.html.twig', [
            'discussing' => $discussing,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_discussing_delete', methods: ['POST'])]
    public function delete(Request $request, Discussing $discussing, DiscussingRepository $discussingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$discussing->getId(), $request->request->get('_token'))) {
            $discussingRepository->remove($discussing, true);
        }

        return $this->redirectToRoute('app_discussing_index', [], Response::HTTP_SEE_OTHER);
    }
}
