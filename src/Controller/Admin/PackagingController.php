<?php

namespace App\Controller\Admin;

use App\Entity\Packaging;
use App\Form\PackagingType;
use App\Repository\PackagingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/packaging", name="admin_")
 */
class PackagingController extends AbstractController
{
    /**
     * @Route("/", name="packaging_index", methods={"GET"})
     */
    public function index(PackagingRepository $packagingRepository): Response
    {
        return $this->render('admin/packaging/index.html.twig', [
            'packagings' => $packagingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="packaging_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $packaging = new Packaging();
        $form = $this->createForm(PackagingType::class, $packaging);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($packaging);
            $entityManager->flush();

            return $this->redirectToRoute('admin_packaging_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/packaging/new.html.twig', [
            'packaging' => $packaging,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="packaging_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Packaging $packaging): Response
    {
        $form = $this->createForm(PackagingType::class, $packaging);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_packaging_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/packaging/edit.html.twig', [
            'packaging' => $packaging,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="packaging_delete", methods={"POST"})
     */
    public function delete(Request $request, Packaging $packaging): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packaging->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($packaging);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_packaging_index', [], Response::HTTP_SEE_OTHER);
    }
}
