<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    private $repoproduit;
    public function __construct(ProduitRepository $repos)
    {
        $this->repoproduit = $repos;
    }

    /**
     * @Route("/produit/ajout/{nom}/{prix}/{desc}", name="produit_ajout")
     */
    public function index($nom, $prix, $desc): Response
    {
        $produit = new Produit();

        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setDescription($desc);

        $em = $this->getDoctrine()->getManager();

        $em->persist($produit);
        $em->flush();

        return $this->render('produit/index.html.twig', [
            "produit" => $produit,
        ]);
    }
    /**
     * @Route("/produits", name="produit_list")
     */
    public function liste(): Response
    {

        // $repos=$this->getDoctrine()->getRepository(Produit::class);
        $produits = $this->repoproduit->findAll();


        return $this->render('produit/list.html.twig', [
            "produits" => $produits,
        ]);
    }
    /**
     * @Route("/produits/parprix/{prix}", name="produit_list_parprix")
     */
    public function listeparprix($prix): Response
    {

        // $repos=$this->getDoctrine()->getRepository(Produit::class);
        $produits = $this->repoproduit->findAllGreaterThanPrice($prix);


        return $this->render('produit/list.html.twig', [
            "produits" => $produits,
        ]);
    }
    /**
     * @Route("/produits/{id}", name="produit_detail")
     */
    public function detail($id, ProduitRepository $repos): Response
    {

        $produit = $repos->find($id);
        if ($produit) {

            return $this->render('produit/detail.html.twig', [
                "produit" => $produit,
            ]);
        }
        return $this->render('produit/erreur.html.twig', [
            "msg" => 'Not found Impossible de trouver un produit ayant le id :'.$id,
        ]);

    }
    /**
     * @Route("/produits/delete/{id}", name="produit_delete")
     */
    public function delete($id, ProduitRepository $repos): Response
    {

        $produit = $repos->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('produit_list');
        /* return $this->render('produit/detail.html.twig', [
            "produit"=>$produit,
        ]);*/
    }
    /**
     * @Route("/produits/update/{id}/{nouvprix}", name="produit_update")
     */
    public function update($id, $nouvprix, ProduitRepository $repos): Response
    {

        $produit = $repos->find($id);
        
        $produit->setPrix($nouvprix);

        $em = $this->getDoctrine()->getManager();

        $em->persist($produit);
        $em->flush();
        return $this->redirectToRoute('produit_detail', ["id" => $produit->getId()]);
        /* return $this->render('produit/detail.html.twig', [
            "produit"=>$produit,
        ]);*/
    }
}
