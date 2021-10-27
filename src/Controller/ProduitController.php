<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/ajout/{nom}/{prix}/{desc}", name="produit")
     */
    public function index($nom,$prix,$desc): Response
    {
        $produit = new Produit();

        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setDescription($desc);

        $em=$this->getDoctrine()->getManager();

        $em->persist($produit);
        $em->flush();

        return $this->render('produit/index.html.twig', [
            "produit"=>$produit,
        ]);
    }
    /**
     * @Route("/produits", name="produit")
     */
    public function liste(): Response
    {
        
        $repos=$this->getDoctrine()->getRepository(Produit::class);
        $produits = $repos->findAll();
       

        return $this->render('produit/list.html.twig', [
            "produits"=>$produits,
        ]);
    }
}
