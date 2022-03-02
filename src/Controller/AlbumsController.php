<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumsController extends AbstractController
{
    #[Route('/albums', name: 'albums')]
    public function index(): Response
    {
        $albums = $this->getDoctrine()
            ->getRepository(Album::class)
            //->findBy([],["id" => "DESC"],10,($page-1)*10);
            ->findAll();

        return $this->render('albums/index.html.twig', [
            //'controller_name' => 'AlbumsController',
            'albums' =>$albums
        ]);
    }
}
