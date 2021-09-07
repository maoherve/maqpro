<?php

namespace App\Controller;

use App\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $themes = $this->getDoctrine()
            ->getRepository(Theme::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'themes' => $themes,
        ]);
    }
}
