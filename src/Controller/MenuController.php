<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     pas de route, ça renvoie une vue partielle
     */
    public function _menu(): Response
    {
        return $this->render('menu/_menu.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}
