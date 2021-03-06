<?php

namespace App\Controller\Admin;

use App\Entity\Colours;
use App\Form\ColoursType;
use App\Repository\ColoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/colours")
 */
class ColoursController extends AbstractController
{
    /**
     * @Route("/", name="admin_colours_index", methods={"GET"})
     */
    public function index(ColoursRepository $coloursRepository): Response
    {
        return $this->render('admin/colours/index.html.twig', [
            'colours' => $coloursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_colours_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('admin_colours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/colours/new.html.twig', [
            'colour' => $colour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_colours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Colours $colour): Response
    {
        $form = $this->createForm(ColoursType::class, $colour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_colours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/colours/edit.html.twig', [
            'colour' => $colour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_colours_delete", methods={"POST"})
     */
    public function delete(Request $request, Colours $colour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($colour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_colours_index', [], Response::HTTP_SEE_OTHER);
    }
}
