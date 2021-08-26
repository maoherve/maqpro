<?php

namespace App\Controller;

use App\Entity\Makeup;
use App\Entity\MakeupProducts;
use App\Repository\MakeupRepository;
use App\Repository\MakeupProductsRepository;
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
     * @param MakeupRepository $makeupRepository
     * @param int $makeup_id
     * @return Response
     * @Route("/{makeup_id}", name="Products")
     */
    public function showByProduct(MakeupRepository $makeupRepository, int $makeup_id): Response
    {
        $makeup = $makeupRepository->find(['id' => $makeup_id]);

        return $this->render('makeup_home/makeupDetails.html.twig',
            ['makeupProducts' => $makeup->getMakeupProducts(),
                'makeupName' => $makeup->getName()
                ]);
    }

    /**
     * @param MakeupProductsRepository $makeupProductRepository
     * @param int $makeup_product_id
     * @return Response
     * @Route("/ref/{makeup_product_id}", name="ref")
     */
    public function showProductRef(MakeupProductsRepository $makeupProductRepository, int $makeup_product_id): Response
    {
        $makeupProduct = $makeupProductRepository->find(['id' => $makeup_product_id]);

        return $this->render('makeup_home/makeupRef.html.twig',
            ['makeupProductsRef' => $makeupProduct->getMakeupRefs(),
            ]);
    }
}