<?php

namespace ModuleGestionBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends BaseController
{
    public function loginAction(Request $request)
    {
    	$response = parent::loginAction($request);
    	var_dump($request->request->All());die();
    	return $this->render('ModuleGestionBundle:Default:index.html.twig');
   	}
}

