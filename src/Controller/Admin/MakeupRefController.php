<?php

namespace App\Controller\Admin;

use App\Entity\MakeupRef;
use App\Form\MakeupRefType;
use App\Repository\MakeupRefRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/makeup/ref")
 */
class MakeupRefController extends AbstractController
{
    /**
     * @Route("/", name="admin_makeup_ref_index", methods={"GET"})
     */
    public function index(MakeupRefRepository $makeupRefRepository): Response
    {
        return $this->render('admin/makeup_ref/index.html.twig', [
            'makeup_refs' => $makeupRefRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_makeup_ref_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $makeupRef = new MakeupRef();
        $form = $this->createForm(MakeupRefType::class, $makeupRef);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($makeupRef);
            $entityManager->flush();

            return $this->redirectToRoute('admin_makeup_ref_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/makeup_ref/new.html.twig', [
            'makeup_ref' => $makeupRef,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="admin_makeup_ref_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MakeupRef $makeupRef): Response
    {
        $form = $this->createForm(MakeupRefType::class, $makeupRef);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_makeup_ref_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/makeup_ref/edit.html.twig', [
            'makeup_ref' => $makeupRef,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_makeup_ref_delete", methods={"POST"})
     */
    public function delete(Request $request, MakeupRef $makeupRef): Response
    {
        if ($this->isCsrfTokenValid('delete'.$makeupRef->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($makeupRef);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_makeup_ref_index', [], Response::HTTP_SEE_OTHER);
    }
}
