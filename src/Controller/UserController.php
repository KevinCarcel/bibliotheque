<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/utilisateur/{id}', 'app_user_show')]
    public function index()
    {
        return $this->render('user/index.html.twig',[
            'controller_name' => 'UserController',
        ]);
    }



    #[Route('/utilisateur/edition/{id}', name: 'app_user_edit')]
    public function edit(UserRepository $userRepository, int $id,Request $request, EntityManagerInterface $manager,UserPasswordHasherInterface $hasher): Response
    {
        $user = $userRepository->findOneBy(['id'=>$id]);
        //verif si le user est connecté
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        //verif si le user connecté est le meme que nous avons recuperer
        if($this->getUser() !== $user) {
            return $this->redirectToRoute('app_user_edit');
        }
        //creation du formulaire
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success2','Les informations de votre compte ont bien été modifiées');

            return $this->redirectToRoute('home.index');
        }
        return $this->render('user/edit.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/utilisateur/edition-mot-de-passe/{id}', name:'user_edit_password', methods: ['GET','POST'])]
    public function editPassword(UserRepository $userRepository, int $id, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher) : Response
    {
        //récupération du user par son $id
        $user = $userRepository->findOneBy(['id'=>$id]);

        $form = $this->createForm(UserPasswordType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())){
                $user->setPassword($hasher->hashPassword($user, $form->getData()['NewPassword']));
            
            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash('success','Le mot de passe à été modifié'
            );
            return $this->redirectToRoute('home.index');
        }else {
            $this->addFlash('warning','le mot de passe est incorrect');
        }
    }
        
        return $this->render('user/editpass.html.twig',[
            'form'=>$form->createView(),
        ]);
    }
}