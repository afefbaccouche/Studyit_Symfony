<?php

namespace PaiementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PaiementBundle:Default:index.html.twig');
    }
}
