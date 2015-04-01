<?php

namespace Esprit\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function contactAction()
    {
        return $this->render('EspritproduitBundle:Default:index.html.twig', array('name' => $name));
    }
}
