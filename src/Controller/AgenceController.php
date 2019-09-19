<?php
namespace App\Controller;

use App\Entity\Agence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use Doctrine\Common\Persistence\ObjectManager;
//use Doctrine\Bundle\FixtureBundle\Fixture;


class AgenceController extends AbstractController
{
    /**
     * @Route("/", name="agence")
     */
    public function index()
    {
       
        return $this->render('agence/index.html.twig');

    }

    /**
     * @Route("/biens", name="biens")
     */
    public function biens()

    {
        $rep=$this->getDoctrine()->getRepository(Agence::class);
      $res=$rep->findAll();
       
        return $this->render('agence/biens.html.twig', [
            'resultats' => $res,
        ]);
        
    }

    /**
     * @Route("/infos-{id}", name="info")
     */
    public function infos($id){
        $rep=$this->getDoctrine()->getRepository(Agence::class);
      $res=$rep->find($id);
        return $this->render('agence/infos.html.twig', [
            'resultats' => $res,
        ]);
      
    }
}
