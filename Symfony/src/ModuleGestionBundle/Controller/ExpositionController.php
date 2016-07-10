<?php

namespace ModuleGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use ModuleGestionBundle\Entity\Exposition;
use ModuleGestionBundle\Entity\TextExposition;
use ModuleGestionBundle\Form\ExpositionType;
use ModuleGestionBundle\Entity\Emplacement;
use ModuleGestionBundle\Entity\Oeuvre;
use Symfony\Component\Validator\Constraints\DateTime;
/**
 * Exposition controller.
 *
 */
class ExpositionController extends Controller
{
    /**
     * Lists all Exposition entities.
     *
     */
    public function indexAction()
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $em = $this->getDoctrine()->getManager();

        $expositions = $em->getRepository('ModuleGestionBundle:Exposition')->findAll();

        return $this->render('exposition/index.html.twig', array(
            'expositions' => $expositions,
            'role'        => $role,
        ));
    }

    /**
     * Creates a new Exposition entity.
     *
     */
    public function newAction(Request $request)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $exposition = new Exposition();
        $emplacement = new Emplacement();
        $form = $this->createForm('ModuleGestionBundle\Form\ExpositionType', $exposition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $id = 0;
            $this->TestDebugExpoAction($request, $id);

            $file = $request->files->get("exposition")["fichier"];
            // On génère un nom unique pour ce fichier 
            $filename = md5(uniqid()).'.'.$file->getClientOriginalExtension();
            // Fonction pour calculer la taille du fichier
            function taille_fichier($octets) {
                $resultat = $octets;
                for ($i=0; $i < 8 && $resultat >= 1024; $i++) {
                    $resultat = $resultat / 1024;
                }
                if ($i > 0) {
                    return preg_replace('/,00$/', '', number_format($resultat, 2, ',', '')) 
            . ' ' . substr('KMGTPEZY',$i-1,1) . 'o';
                } else {
                    return $resultat . ' o';
                }
            }

            // On déplace ensuite le fichier dans le dossier prévu à cette effet
            $file->move(
                $this->container->getParameter('multimedias_directory'),
                $filename
            );

            $stockage = taille_fichier($file->getClientSize());
            $exposition->setStockage($stockage);
            $exposition->setFichier($filename);

            $em = $this->getDoctrine()->getManager();
            $em->persist($exposition);
            $em->flush();

            return $this->redirectToRoute('exposition_show', array(
                'id' => $exposition->getId()
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $oeuvres = $em->getRepository('ModuleGestionBundle:Oeuvre')->findAll();

        return $this->render('exposition/new.html.twig', array(
            'exposition' => $exposition,
            'form' => $form->createView(),
            'role' => $role,
            'oeuvres' => $oeuvres,
        ));
    }

    /**
     * Finds and displays a Exposition entity.
     *
     */
    public function showAction(Exposition $exposition)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($exposition);
        
        return $this->render('exposition/show.html.twig', array(
            'exposition' => $exposition,
            'delete_form' => $deleteForm->createView(),
            'role'        => $role,
        ));
    }

    /**
     * Displays a form to edit an existing Exposition entity.
     *
     */
    public function editAction(Request $request, Exposition $exposition)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        // On stock son id
        $id = $exposition->getId();
        // On appelle l'entity manager
        $em = $this->getDoctrine()->getManager();
        // On fait une requête pour récupérer les info de l'expo
        $exposition = $em->getRepository('ModuleGestionBundle:Exposition')->find($id);
        // Si il n'existe pas on déclenche une erreur
        if(!$exposition) {
            throw $this->createNotFoundException('Aucune Exposition avec l\'id '.$id);
        }
        // On créé un tableau 
        $originalTextExpositions = new ArrayCollection();
        // On boucle sur l'exposition pour récupérer ses traduction existante
        foreach ($exposition->getTextExpositions() as $textexposition) {
            $originalTextExpositions->add($textexposition);
        }

        // On créé un tableau 
        $originalEmplacements = new ArrayCollection();
        // On boucle sur l'exposition pour récupérer ses traduction existante
        foreach ($exposition->getEmplacements() as $emplacement) {
            $originalEmplacements->add($emplacement);
        }

        $editForm = $this->createForm('ModuleGestionBundle\Form\ExpositionType', $exposition);
        $editForm->remove("fichier");
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // On parcourt chacun des traduction existants 
            foreach ($originalTextExpositions as $textexposition) {

                // Si la traduction existant n'est pas contenu dans le formulaire on l'efface
                if(false === $exposition->getTextExpositions()->contains($textexposition)) {

                    $em->remove($textexposition);
                }    
            }
            foreach ($originalEmplacements as $emplacement) {

                // Si la traduction existant n'est pas contenu dans le formulaire on l'efface
                if(false === $exposition->getEmplacements()->contains($emplacement)) {

                    $em->remove($emplacement);
                }    
            }

            $this->TestDebugExpoAction($request, $id);

            $em->persist($exposition);
            $em->flush();

            return $this->redirectToRoute('exposition_index', array(
                'id' => $id,
            ));
        }

        return $this->render('exposition/edit.html.twig', array(
            'exposition' => $exposition,
            'edit_form' => $editForm->createView(),
            'role'        => $role,
        ));
    }

    /**
     * Deletes a Exposition entity.
     *
     */
    public function deleteAction(Request $request, Exposition $exposition)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $em = $this->getDoctrine()->getManager();
        $em->remove($exposition);
        $em->flush();

        return $this->redirectToRoute('exposition_index');
    }

    /**
     * Creates a form to delete a Exposition entity.
     *
     * @param Exposition $exposition The Exposition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Exposition $exposition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('exposition_delete', array('id' => $exposition->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function TestDebugExpoAction(Request $request, $idExpo)
    {
        $emplacements = $request->request->get('exposition')['emplacements'];
        //Test si plusieurs fois la même position
        if (is_array($emplacements))
        {
            $pos = array();
            foreach ($emplacements as $emp => $value) {
                if(!in_array($value['position'], $pos))
                {
                    array_push($pos, $value['position']);
                } else {
                    throw $this->createNotFoundException('L\'exposition que vous êtes en train de créer a des oeuvres qui possédent la même position.');
                    break;
                }
            }
        }
        //Test si plusieurs fois la même oeuvre
        if (is_array($emplacements))
        {
            $pos = array();
            foreach ($emplacements as $emp => $value) {
                if(!in_array($value['oeuvre'], $pos))
                {
                    array_push($pos, $value['oeuvre']);
                } else {
                    throw $this->createNotFoundException('L\'exposition que vous êtes en train de créer a des oeuvres qui possédent le même nom.');
                    break;
                }
            }
        }
        $dateDebut = $request->request->get('exposition')['dateHeureDebutExposition'];
        $dateDebut = str_replace("/", "-", $dateDebut);
        $dateDebut = date("Y-m-d H:i", strtotime($dateDebut));
        $dateD = new \DateTime($dateDebut);
        $dateFin = $request->request->get('exposition')['dateHeureFinExposition'];
        $dateFin = str_replace("/", "-", $dateFin);
        $dateFin = date("Y-m-d H:i", strtotime($dateFin));
        $dateF = new \DateTime($dateFin);
        //Test si date de début inférieur à la date de fin 
        if ($dateD > $dateF)
        {
            throw $this->createNotFoundException('L\'exposition que vous êtes en train de créer a la date de fin inférieur à la date de début.');
        }

        //Test si date de début est bien supérieur de 3 jour par rapport à la dernière date
        //de fin des expositions enregistrer
        $connection = $this->get('database_connection');
        $query = "SELECT e.dateHeureFinExposition as datefin, e.dateHeureDebutExposition as datedeb
                  FROM Exposition as e
                  WHERE id <> ".$idExpo;
        $ExpoTrouve = $connection->fetchAll($query);
        $verif = true;
        foreach ($ExpoTrouve as $Expo)
        {
            if($Expo['datefin'] != "" && $Expo['datedeb'] != "")
            {
                $dateFinReq = date("Y-m-d H:i", strtotime($Expo['datefin']." +4 days"));
                $date = new \DateTime($dateFinReq);

                $dateDebutTrouve = $request->request->get('exposition')['dateHeureDebutExposition'];
                $dateDebutTrouve = str_replace("/", "-", $dateDebutTrouve);
                $dateDebut = new \DateTime($dateDebutTrouve);
                if($date > $dateDebut)
                {
                    $verif = false;
                }
                $dateDebReq = $Expo['datedeb'];
                $date = new \DateTime($dateDebReq);

                $dateFinTrouve = $request->request->get('exposition')['dateHeureFinExposition'];
                $dateFinTrouve = str_replace("/", "-", $dateDebutTrouve);
                $dateFin = new \DateTime($dateDebutTrouve);
                if($date > $dateFin)
                {
                    $verif = false;
                }
            }
            if($verif == false)
            {
                break;
            }
        }
        if ($verif == false)
        {
            throw $this->createNotFoundException('Vous ne pouvais pas créer une exposition avec moins de 3 jours de séparation avec la dernière');
        }
        //Test Le nom de l'exposition existe déjà
        $nomExpo = $request->request->get('exposition')['nomExposition'];
        $query = "SELECT e.nomExposition as nom
                  FROM Exposition as e
                  WHERE e.id <> ".$idExpo."
                  AND e.nomExposition ='".$nomExpo."'";
        $nomExpoTrouve = $connection->fetchAll($query);
        if(!empty($nomExpoTrouve))
        {
            throw $this->createNotFoundException('Vous ne pouvais pas créer une exposition dont le nom existe déjà.');
        }
        //Test si la langue est présente en plusieurs fois
        $textexpositions = $request->request->get('exposition')['textexpositions'];
        if (is_array($textexpositions))
        {
            $pos = array();
            foreach ($textexpositions as $text => $value) {
                if(!in_array($value['langue'], $pos))
                {
                    array_push($pos, $value['langue']);
                } else {
                    throw $this->createNotFoundException('L\'exposition que vous êtes en train de créer posséde plusieurs fois la langue.');
                    break;
                }
            }
        }
    }
}
