<?php

namespace App\Controller;

use ContainerJfbSxm2\getRedirectControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        //Constituer le modèle à transmettre à la vue
        $finder=new Finder();
        $finder->directories()->in("../public/Photos");
        //je transmets le modèle à la vue
        return $this->render('home/index.html.twig', [
            "dossiers"=>$finder
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
