<?php

namespace ModuleDiffusionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ModuleGestionBundle\Entity\Exposition;
use ModuleGestionBundle\Entity\Oeuvre;
use ModuleGestionBundle\Entity\Emplacement;

/**
 * Accueil controller.
 *
 */
class AccueilController extends Controller
{
	public function indexAction()
	{
		//Connection à la base de données
        $connection = $this->get('database_connection');

        // récupérer la liste complète des oeuvres
        $query = "select e.nomExposition as nomEx, oe.nom as nomOe from Exposition as e
        		  inner join Emplacement as em on e.id=em.exposition_id
        		  inner join Oeuvre as oe on oe.id=em.oeuvre_id
        		  where e.id=21";

        // On stocke le résultat
        $rows = $connection->fetchAll($query);

		return $this->render('ModuleDiffusion/accueil/index.html.twig', array(
			'rows' => $rows));
	}
}