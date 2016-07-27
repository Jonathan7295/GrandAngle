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
        $dateJour = new \Datetime();
        $date = $dateJour->format('Y-m-d');
        $langue = "fr";
        
	   //Connection à la base de données
        $connection = $this->get('database_connection');

        // récupérer la liste complète des oeuvres
        $query = "select e.nomExposition as nomEx, oe.nom as nomOe, oe.image as img, oe.nom_image as nomImg, texe.description as des from Exposition as e
        		  inner join Emplacement as em on e.id=em.exposition_id
        		  inner join Oeuvre as oe on oe.id=em.oeuvre_id
                  inner join Text_exposition as texe on e.id=texe.exposition_id
        		  where FORMAT(e.dateHeureDebutExposition,'Y-m-d') <= '".$date."'and FORMAT(e.dateHeureFinExposition,'Y-m-d') >= '".$date."' and texe.langue='".$langue."'";

                // On stocke le résultat
                $rows = $connection->fetchAll($query);

        return $this->render('ModuleDiffusion/accueil/index.html.twig', array(
        	'rows' => $rows));
	}

    public function agendaAction()
    {
            return $this->render('ModuleDiffusion/accueil/agenda.html.twig');

    }
}