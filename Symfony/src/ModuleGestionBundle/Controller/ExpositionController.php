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

            $emplacements = $request->request->get('exposition')['emplacements'];
            if (is_array($emplacements))
            {
                $erreur = false;
                $pos = array();
                foreach ($emplacements as $emp => $value) {
                    if(!in_array($value['position'], $pos))
                    {
                        array_push($pos, $value['position']);
                    } else {
                        $erreur = true;
                        break;
                    }
                }
            }
            if ($erreur == true)
            {
                throw $this->createNotFoundException('L\'exposition que vous êtes en train de créer a des oeuvres qui possédent la même position.');
                $em = $this->getDoctrine()->getManager();
                $oeuvres = $em->getRepository('ModuleGestionBundle:Oeuvre')->findAll();

                return $this->render('exposition/new.html.twig', array(
                    'exposition' => $exposition,
                    'form' => $form->createView(),
                    'role' => $role,
                    'oeuvres' => $oeuvres,
                ));
            } 
            else 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($exposition);
                $em->flush();

                return $this->redirectToRoute('exposition_show', array('id' => $exposition->getId()));
            }
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

            $em->persist($exposition);
            $em->flush();

            return $this->redirectToRoute('exposition_edit', array(
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
}
