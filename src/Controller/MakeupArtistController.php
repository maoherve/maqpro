<?php

namespace App\Controller;

use App\Entity\MakeupArtist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MakeupArtistController extends AbstractController
{
    /**
     * @Route("/makeup/artist", name="makeup_artist")
     */
    public function index(): Response
    {

        $makeupArtist = $this->getDoctrine()
            ->getRepository(MakeupArtist::class)
            ->findAll();

        return $this->render('makeup_artist/index.html.twig', [
                'makeupArtist' => $makeupArtist,
            ]
        );
    }
}
