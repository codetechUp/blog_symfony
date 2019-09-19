<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Agence;
use Symfony\Component\HttpFoundation\Request;
use  App\Form\AgenceType;
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $rep=$this->getDoctrine()->getRepository(Agence::class);
        $res=$rep->findAll();
        return $this->render('admin/index.html.twig', [
            'resultats' => $res,
        ]);
    }

    /**
     * @Route("/creer", name="creer")
     */
    public function creer(Request $req)
    {
        $a=new Agence();
       $form=$this->createForm(AgenceType::class,$a);
       $form->handleRequest($req);
       if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($a);
        $em->flush();
        $this->addFlash("success","Creer avec success");
        return $this->redirectToRoute("admin");
       }
        return $this->render('admin/creer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

/**
     * @Route("/editer_{id}", name="editer")
     */
    public function editer($id,Request $req)
    {
        $rep=$this->getDoctrine()->getRepository(Agence::class);
        $res=$rep->find($id);
       $form=$this->createForm(AgenceType::class,$res);
       $a=$form->handleRequest($req);
       if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash("success","Editer avec success");
        return $this->redirectToRoute("admin");
        
       }
        return $this->render('admin/editer.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/delete_{id}", name="delete")
     */
    public function delete($id,Request $req)
    {
        $rep=$this->getDoctrine()->getRepository(Agence::class);
        $res=$rep->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($res);
        $em->flush();
        $this->addFlash("success","Supprimer avec success");
        
        return $this->redirectToRoute("admin");
        
    }
}
