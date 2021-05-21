<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UberEatType;

class CardController extends AbstractController
{

    /**
     * @Route("/form", name="formulairePost", methods={"POST"})
     */
    public function traitementFormulaire(Request $request): Response
    {
        $form = $this->createForm(UberEatType::class);
        $form->handleRequest($request);

        $data = $form->getData();

        var_dump($data);
        die();

        return $this->render('card/index.html.twig',
        [
            'controller_name' => 'CardController',
            'monFormulaire' => $form->createView()
        ]);
    }


    /**
     * @Route("/form", name="form", methods={"GET"})
     */
    public function index(): Response
    {
        $form = $this->createForm(UberEatType::class);
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
            'monFormulaire' => $form->createView(),
        ]);
    }


}