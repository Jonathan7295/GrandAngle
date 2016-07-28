<?php

namespace ModuleDiffusionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ModuleGestionBundle\Entity\Exposition;
use ModuleGestionBundle\Entity\Oeuvre;
use ModuleGestionBundle\Entity\Emplacement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        		  where DATE_FORMAT(e.dateHeureDebutExposition,'%Y-%m-%d') <= '".$date."'and DATE_FORMAT(e.dateHeureFinExposition,'%Y-%m-%d') >= '".$date."' and texe.langue='".$langue."'";

                // On stocke le résultat
                $rows = $connection->fetchAll($query);

        return $this->render('ModuleDiffusion/accueil/index.html.twig', array(
        	'rows' => $rows));
	}

    public function agendaAction()
    {
            return $this->render('ModuleDiffusion/accueil/agenda.html.twig');

    }

    public function oeuvreAction(Request $req)
    {
        if($req->isXMLHttpRequest()){

            //Connection à la base de données
            $connection = $this->get('database_connection');
            $date = new \DateTime();
            $date = $date->format('Y-m-d H:i:s');
            $query = "SELECT o.nom as nom, o.id as id, e.id as idEx, o.image as fichier
                      FROM Exposition as e
                      INNER JOIN Emplacement em
                      ON em.exposition_id = e.id
                      INNER JOIN Oeuvre o
                      ON em.oeuvre_id = o.id
                      WHERE e.dateHeureDebutExposition <= '".$date."'
                      AND e.dateHeureFinExposition >= '".$date."'";
            $rows = $connection->fetchAll($query);
                    
            // Puis on le renvoie dans un tableau en Json
            return new JsonResponse(array('data' => json_encode($rows)));

        // Sinon on charge normalement
        }else{
            $em = $this->getDoctrine()->getManager();
            $expositions = $em->getRepository('ModuleGestionBundle:Exposition')->findAll();
            $connection = $this->get('database_connection');
            $date = new \DateTime();
            $date = $date->format('Y-m-d H:i:s');
            $query = "SELECT o.nom as nom, o.id as id, e.id as idEx, o.image as fichier
                      FROM Exposition as e
                      INNER JOIN Emplacement em
                      ON em.exposition_id = e.id
                      INNER JOIN Oeuvre o
                      ON em.oeuvre_id = o.id
                      WHERE e.dateHeureDebutExposition <= '".$date."'
                      AND e.dateHeureFinExposition >= '".$date."'";
            $oeuvres = $connection->fetchAll($query);
            return $this->render('ModuleDiffusion/accueil/oeuvre.html.twig', array(
                'expositions' => $expositions,
                'oeuvres' => $oeuvres
                ));
        }
    }

    public function listexpoAction(Request $request)
    {
        if($request->isXMLHttpRequest()) 
        {
            $connection = $this->get('database_connection');
            $id = $request->get("id");
            $query = "SELECT e.id as idEx, o.nom as nomO, o.id as idO, o.image as fichier
                      FROM Exposition e
                      INNER JOIN Emplacement em
                      ON em.exposition_id = e.id
                      INNER JOIN Oeuvre o
                      ON em.oeuvre_id = o.id
                      WHERE e.id =".$id;
            $data = $connection->fetchAll($query);
            return new JsonResponse(array('data' => json_encode($data)));
        }
        return new Response("Erreur : Ce n'est pas une requête Ajax", 400);
    }

    public function detailAction(Oeuvre $oeuvre)
    {
        return $this->render('ModuleDiffusion/accueil/detail_oeuvre.html.twig', array(
            'oeuvre' => $oeuvre
        ));
    }
}