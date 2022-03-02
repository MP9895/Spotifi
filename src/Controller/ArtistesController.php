<?php

namespace App\Controller;

use App\Entity\Artiste;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistesController extends AbstractController
{
    #[Route('/artistes', name: 'artistes')]
    public function index(): Response
    {
        $artistes = $this->getDoctrine()
            ->getRepository(Artiste::class)
            //->findBy([],["id" => "DESC"],10,($page-1)*10);
            ->findAll();

        return $this->render('artistes/index.html.twig', [
            //'controller_name' => 'ArtistesController',
            'artistes' =>$artistes,
        ]);
    }
}
