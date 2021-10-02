<?php

namespace App\Controller\Admin;

use App\Entity\GeneralPublic;
use App\Form\GeneralPublicType;
use App\Repository\GeneralPublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/general/public")
 */
class AdminGeneralPublicController extends AbstractController
{
    /**
     * @Route("/", name="admin_general_public_index", methods={"GET"})
     */
    public function index(GeneralPublicRepository $generalPublicRepository): Response
    {
        return $this->render('admin/admin_general_public/index.html.twig', [
            'general_publics' => $generalPublicRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_general_public_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $generalPublic = new GeneralPublic();
        $form = $this->createForm(GeneralPublicType::class, $generalPublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($generalPublic);
            $entityManager->flush();

            return $this->redirectToRoute('admin_general_public_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_general_public/new.html.twig', [
            'general_public' => $generalPublic,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="admin_general_public_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GeneralPublic $generalPublic): Response
    {
        $form = $this->createForm(GeneralPublicType::class, $generalPublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_general_public_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_general_public/edit.html.twig', [
            'general_public' => $generalPublic,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_general_public_delete", methods={"POST"})
     */
    public function delete(Request $request, GeneralPublic $generalPublic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$generalPublic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($generalPublic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_general_public_index', [], Response::HTTP_SEE_OTHER);
    }
}
