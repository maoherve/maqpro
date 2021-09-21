<?php

namespace App\Controller;

use App\Entity\Colours;
use App\Form\ColoursType;
use App\Repository\ColoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/colours")
 */
class ColoursController extends AbstractController
{
    /**
     * @Route("/", name="colours_index", methods={"GET"})
     */
    public function index(ColoursRepository $coloursRepository): Response
    {
        return $this->render('colours/index.html.twig', [
            'colours' => $coloursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="colours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $colour = new Colours();
        $form = $this->createForm(ColoursType::class, $colour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($colour);
            $entityManager->flush();

            return $this->redirectToRoute('colours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colours/new.html.twig', [
            'colour' => $colour,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="colours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Colours $colour): Response
    {
        $form = $this->createForm(ColoursType::class, $colour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('colours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colours/edit.html.twig', [
            'colour' => $colour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="colours_delete", methods={"POST"})
     */
    public function delete(Request $request, Colours $colour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($colour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('colours_index', [], Response::HTTP_SEE_OTHER);
    }
}
