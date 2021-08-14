<?php

namespace App\Controller;

use App\Entity\Makeup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 *
 * @Route("/makeup", name="makeup_")
 */
class MakeupHomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * show all the makeup
     * @return Response
     */
    public function index(): Response
    {
        $makeups = $this->getDoctrine()
            ->getRepository(Makeup::class)
            ->findByASC();



        return $this->render('makeup_home/index.html.twig', [
            'makeups' => $makeups
        ]);
    }
}