<?php

namespace App\Controller\Admin;

use App\Entity\MakeupArtist;
use App\Form\MakeupArtistType;
use App\Repository\MakeupArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/makeup/artist")
 */
class AdminMakeupArtistController extends AbstractController
{
    /**
     * @Route("/", name="admin_makeup_artist_index", methods={"GET"})
     */
    public function index(MakeupArtistRepository $makeupArtistRepository): Response
    {
        return $this->render('admin/admin_makeup_artist/index.html.twig', [
            'makeup_artists' => $makeupArtistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_makeup_artist_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $makeupArtist = new MakeupArtist();
        $form = $this->createForm(MakeupArtistType::class, $makeupArtist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($makeupArtist);
            $entityManager->flush();

            return $this->redirectToRoute('admin_makeup_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_makeup_artist/new.html.twig', [
            'makeup_artist' => $makeupArtist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_makeup_artist_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MakeupArtist $makeupArtist): Response
    {
        $form = $this->createForm(MakeupArtistType::class, $makeupArtist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_makeup_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_makeup_artist/edit.html.twig', [
            'makeup_artist' => $makeupArtist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_makeup_artist_delete", methods={"POST"})
     */
    public function delete(Request $request, MakeupArtist $makeupArtist): Response
    {
        if ($this->isCsrfTokenValid('delete'.$makeupArtist->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($makeupArtist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/admin_makeup_artist_index', [], Response::HTTP_SEE_OTHER);
    }
}
