<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\UploadSongFormType;

class UserDashboardController extends AbstractController
{


    #[Route('/user/dashboard', name: 'app_user_dashboard')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(UploadSongFormType::class);
        $user = $this->getUser();
        return $this->render('user_dashboard/index.html.twig', [
            'user' => $user,
            'uploadSong' => $form->createView(),
        ]);
    }
}
