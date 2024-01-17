<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\UploadSongFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

class UserDashboardController extends AbstractController
{


    #[Route('/user/dashboard', name: 'app_user_dashboard')]
    public function index(AuthenticationUtils $authenticationUtils,Request $request,EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UploadSongFormType::class);
        $user = $this->getUser();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $song =new Song();
            $song->setName($form->get('name')->getData());
            $song->setDescription($form->get('description')->getData());
            $song->setGenre($form->get('genre')->getData());

            //UploadedImage
            $uploadedImage = $form->get('image')->getData();
            if ($uploadedImage) {
                $destination = $this->getParameter('songs_images_directory');
                $originalFilename = pathinfo($uploadedImage->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedImage->guessExtension();
                try{
                    $uploadedImage->move(
                        $destination,
                        $newFilename
                    );
                }catch (FileException $e){
                    // ... handle exception if something happens during file upload
                    $e->getMessage();
                }
                $song->setImage($newFilename);
            }

            //UploadedSong
            $uploadedSong = $form->get('location')->getData();      
            if ($uploadedSong) {
                $destination = $this->getParameter('songs_directory');
                $originalFilename = pathinfo($uploadedSong->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedSong->guessExtension();
                try{
                    $uploadedSong->move(
                        $destination,
                        $newFilename
                    );
                }catch (FileException $e){
                    // ... handle exception if something happens during file upload
                    $e->getMessage();
                }
                $song->setLocation($newFilename);
            }

            $song->setUserId($user);
            $entityManager->persist($song);
            $entityManager->flush();
            $this->addFlash('success', 'Song Uploaded Successfully!');

        };
             
        return $this->render('user_dashboard/index.html.twig', [
            'user' => $user,
            'uploadSong' => $form->createView(),
        ]);
    }
}
