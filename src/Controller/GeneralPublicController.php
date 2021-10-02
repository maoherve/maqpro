<?php

namespace App\Controller;

use App\Entity\GeneralPublic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeneralPublicController extends AbstractController
{
    /**
     * @Route("/general/public", name="general_public")
     */
    public function index(): Response
    {

        $generalPublic = $this->getDoctrine()
            ->getRepository(GeneralPublic::class)
            ->findAll();

        return $this->render('general_public/index.html.twig', [
            'generalPublic' => $generalPublic,
        ]);
    }
}
