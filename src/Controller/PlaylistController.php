<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Musique;

class PlaylistController extends AbstractController
{
    #[Route('/playlist', name: 'playlist')]
    public function index(): Response
    {
        $user = $this->getUser();
        $playlist = $user
        ->getMusiques();
        return $this->render('playlist/index.html.twig', [
            //'controller_name' => 'PlaylistController',
            'playlist'=>$playlist,
        ]);
    }

    #[Route('/removePlaylist/{id}', name:'removePlaylist')]
    public function removePlaylist($id) : Response
    {
        $musique = $this->getDoctrine()
        ->getRepository(Musique::class)
        ->find($id);

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager(); 
        $user->removeMusique($musique);

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('playlist');
    }
}
