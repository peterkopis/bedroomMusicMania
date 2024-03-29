<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Security $security,Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        if ($security->getUser()) {
            return $this->redirectToRoute('app_user_dashboard',['user' => $security->getUser()]);
        }
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            //UploadedImage
            $uploadedImage = $form->get('image')->getData();
            if ($uploadedImage) {
                $destination = $this->getParameter('users_images_directory');
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
                $user->setImage($newFilename);
            }
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $authUser = $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
            return $this->redirectToRoute('app_user_dashboard',['user' => $authUser]);
            /*$userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );*/
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
