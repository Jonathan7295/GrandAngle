<?php

namespace ModuleGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ModuleGestionBundle\Entity\Utilisateur;
use ModuleGestionBundle\Entity\Telephone;

use ModuleGestionBundle\Form\UtilisateurType;

/**
 * Utilisateur controller.
 *
 */
class UtilisateurController extends Controller
{
    /**
     * Lists all Utilisateur entities.
     *
     */
    public function indexAction()
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $em = $this->getDoctrine()->getManager();

        $utilisateurs = $em->getRepository('ModuleGestionBundle:Utilisateur')->findAll();

        return $this->render('utilisateur/index.html.twig', array(
            'utilisateurs' => $utilisateurs,
            'role' => $role,
        ));
    }

    /**
     * Creates a new Utilisateur entity.
     *
     */
    public function newAction(Request $request)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $utilisateur = new Utilisateur();

        $form = $this->createForm('ModuleGestionBundle\Form\UtilisateurType', $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $telephones = $request->request->All()["utilisateur"]["telephones"];

            foreach ($telephones as $value) {
                
                $telephone = new Telephone();

                $telephone->setLibelle($value['libelle']);
                $telephone->setNumero($value['numero']);
                $telephone->setUtilisateur($utilisateur);
                $em->persist($telephone);

                $utilisateur->addTelephone($telephone);
            }

            $em->persist($utilisateur);

            $em->flush();

            return $this->redirectToRoute('utilisateur_show', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateur/new.html.twig', array(
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
            'role' => $role,
        ));
    }

    /**
     * Finds and displays a Utilisateur entity.
     *
     */
    public function showAction(Utilisateur $utilisateur)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($utilisateur);

        return $this->render('utilisateur/show.html.twig', array(
            'utilisateur' => $utilisateur,
            'delete_form' => $deleteForm->createView(),
            'role'        => $role,
        ));
    }

    /**
     * Displays a form to edit an existing Utilisateur entity.
     *
     */
    public function editAction(Request $request, Utilisateur $utilisateur)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($utilisateur);

        $editForm = $this->createForm('ModuleGestionBundle\Form\UtilisateurType', $utilisateur);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if(isset($request->request->All()["utilisateur"]["telephones"])){

               $em = $this->getDoctrine()->getManager();

                $telephone = new telephone();

                foreach ($utilisateur->getTelephones()->getSnapshot() as $value) {

                    $telephone = $value;
                    $em->remove($telephone);

                    $utilisateur->removeTelephone($telephone);
                    $em->persist($utilisateur);
            
                }


                foreach ($request->request->All()['utilisateur']['telephones'] as $value) {
                   $telephone = new telephone();
                   $telephone->setLibelle($value['libelle']);
                   $telephone->setNumero($value['numero']);
                   $telephone->setUtilisateur($utilisateur);
                   $em->persist($telephone);
                   $utilisateur->addTelephone($telephone);
                   $em->persist($utilisateur);
                   
                }

                $em->flush();

            }else{

                $em = $this->getDoctrine()->getManager();

                $telephone = new telephone();

                foreach ($utilisateur->getTelephones()->getSnapshot() as $value) {

                    $telephone = $value;
                    $em->remove($telephone);

                    $utilisateur->removeTelephone($telephone);
                    $em->persist($utilisateur);

                    $em->flush();
            
                }

            }

            return $this->redirectToRoute('utilisateur_edit', array(
                'id' => $utilisateur->getId(),
            ));
        }
        return $this->render('utilisateur/edit.html.twig', array(
            'utilisateur' => $utilisateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'role'        => $role,
        ));
    }
    /**
     * Deletes a Utilisateur entity.
     *
     */
    public function deleteAction(Request $request, Utilisateur $utilisateur)
    {
        
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisateur);
            $em->flush();

        return $this->redirectToRoute('utilisateur_index');
    }

    /**
     * Creates a form to delete a Utilisateur entity.
     *
     * @param Utilisateur $utilisateur The Utilisateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Utilisateur $utilisateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateur_delete', array('id' => $utilisateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
