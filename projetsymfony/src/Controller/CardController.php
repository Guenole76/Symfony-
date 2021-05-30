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
     * @Route("/pokemon/{id}", name="pokemon_show")
     */
    public function show(int $id): Response
    {
        $cards = $this->getDoctrine()
            ->getRepository(Pokemon::class)
            ->find($id);

        if (!$cards) {
            throw $this->createNotFoundException(
                'No pokemon found for id '.$id
            );
        }

        return new Response('Check out this great pokemon: '.$cards->getNom());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


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
     * @Route("/pokemon/edit/{id}") 
     */
    public function update(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cards = $entityManager->getRepository(Pokemon::class)->find($id);

        if (!$cards) {
            throw $this->createNotFoundException(
                'No pokemon found for id '.$id
            );
        }

        $cards->setNom('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('pokemon_show', [
            'id' => $cards->getId()
        ]);
    }

    /**
     * @Route("/pokemon/remove/{id}") 
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cards = $entityManager->getRepository(Pokemon::class)->find($id);

        if (!$cards) {
            throw $this->createNotFoundException(
                'No pokemon found for id '.$id
            );
        }

        $entityManager->remove($cards);
        $entityManager->flush();

        return $this->redirectToRoute('pokemon_show', [
            'id' => $cards->getId()
        ]);
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