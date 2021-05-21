<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CardType;
use App\Repository\PokemonRepository;
use App\Entity\Pokemon;

class CardController extends AbstractController
{



    /**
     * @Route ("/pokemon")
     */
    public function PokemonListe()
    {
        $cards = $this->getDoctrine()
            ->getRepository(Pokemon::class)
            ->findAll();

        return ($this->render('card/pokemon.html.twig',
        [
            'cards' => $cards
        ]));
    }

    /**
     * @Route("/form", name="formulairePost", methods={"POST"})
     */
    public function traitementFormulaire(Request $request): Response
    {
        $form = $this->createForm(CardType::class);
        $form->handleRequest($request);

        $data = $form->getData();

        $entityManager = $this->getDoctrine()->getManager();

        $product = new Pokemon();
        $product->setNom($data['Nom']);
        $product->setType($data['Extension']);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

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
        $form = $this->createForm(CardType::class);
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
            'monFormulaire' => $form->createView(),
        ]);
    }


}