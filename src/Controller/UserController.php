<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $rq,ObjectManager $em,UserPasswordEncoderInterface $encode)
    {
        $user= new User();
        $form=$this->createForm(UserFormType::class,$user);
        $form->handleRequest($rq);
        if($form->isSubmitted() && $form->isValid()){
         
         $hash=$encode->encodePassword($user,$user->getPassword());
         $user->setPassword($hash);
          $em->persist($user);
          $em->flush();
          $this->addFlash("success","Vous etes connecte");
          return $this->redirectToRoute('user_connexion');
          
        }
        return $this->render('user/index.html.twig',
        [
            "form" => $form->createView()
        ]);
    }
     /**
     * @Route("/connexion", name="user_connexion")
     */
    public function connexion(AuthenticationUtils $utils){
        $error=$utils->getLastAuthenticationError();
        return $this->render("user/connexion.html.twig",[
            'error'=> $error
        ]);
       

    }
      /**
     * @Route("/deconnexion", name="user_deconnexion")
     */
    public function deconnexion(){

    }

}
