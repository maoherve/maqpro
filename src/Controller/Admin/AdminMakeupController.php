<?php

namespace App\Controller\Admin;

use App\Entity\Makeup;
use App\Form\MakeupType;
use App\Repository\MakeupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/makeup")
 */
class AdminMakeupController extends AbstractController
{
    /**
     * @Route("/", name="admin_makeup_index", methods={"GET"})
     */
    public function index(MakeupRepository $makeupRepository): Response
    {
        return $this->render('admin_makeup/index.html.twig', [
            'makeups' => $makeupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_makeup_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $makeup = new Makeup();
        $form = $this->createForm(MakeupType::class, $makeup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($makeup);
            $entityManager->flush();

            return $this->redirectToRoute('admin_makeup_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_makeup/new.html.twig', [
            'makeup' => $makeup,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_makeup_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Makeup $makeup): Response
    {
        $form = $this->createForm(MakeupType::class, $makeup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_makeup_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_makeup/edit.html.twig', [
            'makeup' => $makeup,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_makeup_delete", methods={"POST"})
     */
    public function delete(Request $request, Makeup $makeup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$makeup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($makeup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_makeup_index', [], Response::HTTP_SEE_OTHER);
    }
}
