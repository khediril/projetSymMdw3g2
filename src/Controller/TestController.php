<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        $nom = "FANTAR Hichem";
        return $this->render('test/test.html.twig', ["ism"=>$nom]);
    }
    /**
     * @Route("/test2", name="test2")
     */
    public function test2(): Response
    {
        return $this->render('test/test2.html.twig', [
            'controller_name' => 'TestController2',
        ]);
    }
    /**
     * @Route("/test3", name="test3")
     */
    public function test3(): Response
    {
        $etudiants = ['hichem','sedki','amani','manel','hamza'];
        return $this->render('test/test3.html.twig', ['etudiants' => $etudiants ]);
    }
    /**
     * @Route("/test4/{name}", name="test4")
     */
    public function test4($name): Response
    {
        $message = "Bonjour ".$name;
        return $this->render('test/test4.html.twig', ['msg' => $message ]);
   
    }
}
 