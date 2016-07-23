<?php

namespace ModuleGestionBundle\Controller;

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