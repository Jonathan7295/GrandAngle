<?php

namespace ModuleGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ModuleGestionBundle\Entity\Artiste;
use ModuleGestionBundle\Form\ArtisteType;

/**
 * Artiste controller.
 *
 */
class ArtisteController extends Controller
{
    /**
     * Lists all Artiste entities.
     *
     */
    public function indexAction()
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $em = $this->getDoctrine()->getManager();

        $artistes = $em->getRepository('ModuleGestionBundle:Artiste')->findAll();

        return $this->render('artiste/index.html.twig', array(
            'artistes' => $artistes,
            'role'        => $role,
        ));
    }

    /**
     * Creates a new Artiste entity.
     *
     */
    public function newAction(Request $request)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $artiste = new Artiste();
        $form = $this->createForm('ModuleGestionBundle\Form\ArtisteType', $artiste);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $nom = $artiste->getNom();
            $prenom = $artiste->getPrenom();

            $criteria = array_filter(array(
                'nom'    => $nom,
                'prenom' => $prenom));

            $artisteFind = $em->getRepository('ModuleGestionBundle:Artiste')->findBy($criteria);

            if(!$artisteFind){

                $em->persist($artiste);
                $em->flush();

                return $this->redirectToRoute('oeuvre_new', array('id' => $artiste->getId()));
            }else{
                $find = $nom." ".$prenom;
                return $this->render('artiste/new.html.twig', array(
                    'artiste' => $artiste,
                    'form' => $form->createView(),
                    'role' => $role,
                    'find' => $find,
                ));
            }  
        }

        return $this->render('artiste/new.html.twig', array(
            'artiste' => $artiste,
            'form' => $form->createView(),
            'role'        => $role,
        ));
    }

    /**
     * Finds and displays a Artiste entity.
     *
     */
    public function showAction(Artiste $artiste)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($artiste);

        return $this->render('artiste/show.html.twig', array(
            'artiste' => $artiste,
            'delete_form' => $deleteForm->createView(),
            'role'        => $role,
        ));
    }

    /**
     * Displays a form to edit an existing Artiste entity.
     *
     */
    public function editAction(Request $request, Artiste $artiste)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($artiste);
        $editForm = $this->createForm('ModuleGestionBundle\Form\ArtisteType', $artiste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artiste);
            $em->flush();

            return $this->redirectToRoute('artiste_edit', array('id' => $artiste->getId()));
        }

        return $this->render('artiste/edit.html.twig', array(
            'artiste' => $artiste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'role'        => $role,
        ));
    }

    /**
     * Deletes a Artiste entity.
     *
     */
    public function deleteAction(Request $request, Artiste $artiste)
    {
        $form = $this->createDeleteForm($artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artiste);
            $em->flush();
        }

        return $this->redirectToRoute('artiste_index');
    }

    /**
     * Creates a form to delete a Artiste entity.
     *
     * @param Artiste $artiste The Artiste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Artiste $artiste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('artiste_delete', array('id' => $artiste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
