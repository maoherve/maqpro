<?php

namespace App\Controller\Admin;

use App\Entity\MakeupRefDetails;
use App\Form\MakeupRefDetailsType;
use App\Repository\MakeupRefDetailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/makeup/ref/details")
 */
class MakeupRefDetailsController extends AbstractController
{
    /**
     * @Route("/", name="admin_makeup_ref_details_index", methods={"GET"})
     */
    public function index(MakeupRefDetailsRepository $makeupRefDetailsRepository): Response
    {
        return $this->render('admin/makeup_ref_details/index.html.twig', [
            'makeup_ref_details' => $makeupRefDetailsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_makeup_ref_details_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $makeupRefDetail = new MakeupRefDetails();
        $form = $this->createForm(MakeupRefDetailsType::class, $makeupRefDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($makeupRefDetail);
            $entityManager->flush();

            return $this->redirectToRoute('admin_makeup_ref_details_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/makeup_ref_details/new.html.twig', [
            'makeup_ref_detail' => $makeupRefDetail,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="admin_makeup_ref_details_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MakeupRefDetails $makeupRefDetail): Response
    {
        $form = $this->createForm(MakeupRefDetailsType::class, $makeupRefDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_makeup_ref_details_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/makeup_ref_details/edit.html.twig', [
            'makeup_ref_detail' => $makeupRefDetail,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_makeup_ref_details_delete", methods={"POST"})
     */
    public function delete(Request $request, MakeupRefDetails $makeupRefDetail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$makeupRefDetail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($makeupRefDetail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/makeup_ref_details_index', [], Response::HTTP_SEE_OTHER);
    }
}
