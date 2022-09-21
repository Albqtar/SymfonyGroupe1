<?php

namespace App\Controller;

use ContainerJfbSxm2\getRedirectControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        //Ajouter un formulaire pour créer un nouveau dossier de chatons

        $form = $this->createFormBuilder() //je récupère un constructeur de formulaire
                ->add("dossier",TextType::class, ["label"=>"Nom du dossier à créer"])
            ->add("ok",SubmitType::class, ["label"=>"OK"])
            ->getForm(); // je récupère une instance de formulaire crée par le builder à la fin
        //Constituer le modèle à transmettre à la vue
        $finder=new Finder();
        $finder->directories()->in("../public/Photos");
        //je transmets le modèle à la vue
        return $this->render('home/index.html.twig', [
            "dossiers"=>$finder,
            "formulaire"=>$form->createView()
        ]);
    }
    /**
    @Route("/voir/{nomDuDossier}", name="afficherDossier")
     *
     */
    public function afficherDossier($nomDuDossier): Response{
        //vérifier si le dossier existe
        $fs=new Filesystem();
        $chemin="../public/Photos/".$nomDuDossier;
        //s'il n'existe pas, je lève une erreur 404
        if(!$fs->exists($chemin))
            throw $this->createNotFoundException("Le Dossier $nomDuDossier n'existe pas");

        $fichierdansledossier=new Finder();
        $fichierdansledossier->files()->in("../public/Photos/".$nomDuDossier);


        return $this->render('home/afficherDossier.html.twig', [
            "nomDuDossier"=>$nomDuDossier,
            "fichierdansledossier"=>$fichierdansledossier
            ]);



    }
}
