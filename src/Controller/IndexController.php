<?php

namespace App\Controller;

use App\Entity\Musique;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        
        $musiques = $this->getDoctrine()
            ->getRepository(musique::class)
            //->findBy([],["id" => "DESC"],10,($page-1)*10);
            ->findAll();

        return $this->render('index/index.html.twig', [
            // 'controller_name' => 'IndexController',
            'musiques' =>$musiques
        ]);
    }
    #[Route('/ajoutPlaylist/{id}', name:'ajoutPlaylist')]
    public function ajoutPlaylist($id) : Response
    {
        $musique = $this->getDoctrine()
        ->getRepository(Musique::class)
        ->find($id);

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager(); 
        $user->addMusique($musique);

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('home');
    }
    
}