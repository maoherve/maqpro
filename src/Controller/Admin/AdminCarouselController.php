<?php

namespace App\Controller\Admin;

use App\Entity\Carousel;
use App\Form\CarouselType;
use App\Repository\CarouselRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/carousel")
 */
class AdminCarouselController extends AbstractController
{
    /**
     * @Route("/", name="admin_carousel_index", methods={"GET"})
     */
    public function index(CarouselRepository $carouselRepository): Response
    {
        return $this->render('admin/admin_carousel/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_carousel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carousel = new Carousel();
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carousel);
            $entityManager->flush();

            return $this->redirectToRoute('admin_carousel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_carousel/new.html.twig', [
            'carousel' => $carousel,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="admin_carousel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Carousel $carousel): Response
    {
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_carousel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_carousel/edit.html.twig', [
            'carousel' => $carousel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_carousel_delete", methods={"POST"})
     */
    public function delete(Request $request, Carousel $carousel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carousel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carousel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/admin_carousel_index', [], Response::HTTP_SEE_OTHER);
    }
}
