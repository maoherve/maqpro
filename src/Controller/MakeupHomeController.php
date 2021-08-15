<?php

namespace App\Controller;

use App\Entity\Makeup;
use App\Entity\MakeupProducts;
use App\Repository\MakeupRepository;
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


    /**
     * @param MakeupRepository $seasonRepository
     * @param int $makeup_id
     * @return Response
     * @Route("/show-by-season/{makeup_id}", name="Products")
     */
    public function showBySeason(MakeupRepository $seasonRepository, int $makeup_id): Response
    {
        $makeup = $seasonRepository->findOneBy(['id' => $makeup_id]);

        return $this->render('makeup_home/makeupDetails.html.twig',
            ['makeupProducts' => $makeup->getMakeupProducts(),
                'makeupName' => $makeup->getName()
                ]);
    }




}