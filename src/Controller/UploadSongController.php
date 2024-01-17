<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadSongController extends AbstractController
{
    #[Route('/upload', name: 'app_upload_song')]
    public function uploadSong(Request $request): Response
    {
        $songData = $request->request->all();
        dump($songData);
        return $this->render('upload_song/index.html.twig', [
            'controller_name' => 'UploadSongController',
        ]);
    }
}
