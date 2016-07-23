<?php

namespace ModuleDiffusionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Accueil controller.
 *
 */
class AccueilController extends Controller
{
	public function indexAction()
	{
		return $this->render('ModuleDiffusion/accueil/index.html.twig');
	}
}