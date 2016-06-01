<?php

namespace ModuleGestionBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Endroid\Bundle\QrCodeBundle\Controller\QrCodeController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ModuleGestionBundle\Entity\Oeuvre;
use ModuleGestionBundle\Entity\Emplacement;
use ModuleGestionBundle\Form\OeuvreType;

/**
 * Oeuvre controller.
 *
 */
class OeuvreController extends Controller
{
    public function indexAction()
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $em = $this->getDoctrine()->getManager();

        $oeuvres = $em->getRepository('ModuleGestionBundle:Oeuvre')->findAll();
        $expositions = $em->getRepository('ModuleGestionBundle:Exposition')->findAll();

        return $this->render('oeuvre/index.html.twig', array(
            'oeuvres'     => $oeuvres,
            'expositions' => $expositions,
            'role'        => $role,
        ));
    }

    public function listOeuvreAction(Request $req)
    {
         // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $em = $this->getDoctrine()->getManager();

        $expositions = $em->getRepository('ModuleGestionBundle:Exposition')->findAll();

        if($req->isXMLHttpRequest()) {
            $id = $req->get('id');
            $connection = $this->get('database_connection');
            // récupérer la liste des oeuvres
            $query = "select o.nom,o.etat,a.nom as nomArt,a.prenom as preNomArt,o.nombreVisite,e.position,o.id,o.imgFlashcode as img from oeuvre as o
                                    inner join emplacement as e on e.oeuvre_id = o.id
                                    inner join artiste as a on o.artiste_id = a.id 
                                    where e.exposition_id = " . $id;
            $rows = $connection->fetchAll($query);
            return new JsonResponse(array('data' => json_encode($rows)));
        }
        return new Response("Erreur : Ce n'est pas une requête Ajax", 400);
    }

    // Methode non sécurisée pour test qrcode
    public function testOeuvreAction(Oeuvre $oeuvre)
    {
        $deleteForm = $this->createDeleteForm($oeuvre);

        return $this->render('oeuvre/testshow.html.twig', array(
            'oeuvre' => $oeuvre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a new Oeuvre entity.
     *
     */
    public function newAction(Request $request)
    {

        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $oeuvre = new Oeuvre();
        
        $form = $this->createForm('ModuleGestionBundle\Form\OeuvreType', $oeuvre);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($oeuvre);
            $em->flush();

            // Si on a coché pour générer un Qrcode
            if($request->request->All()["oeuvre"]["genFlashcode"] == 1){

               // On récupère l'id de l'oeuvre enregistrée
               $id = $oeuvre->getId();
               // Puis on l'intègre dans le lien de redirection
               $oeuvre->setImgFlashcode('/qrcode/92.156.227.65/GrandAngle/Symfony/web/testoeuvre/'.$id.'/show');
               // On persist le changement
               $em->persist($oeuvre);
               // On enregistre
               $em->flush();
            }

            return $this->redirectToRoute('oeuvre_show', array(
                'id'   => $id,
                'role' => $role,
            ));
        }

        return $this->render('oeuvre/new.html.twig', array(
            'oeuvre' => $oeuvre,
            'form' => $form->createView(),
            'role' => $role,
        ));
    }

    /**
     * Finds and displays a Oeuvre entity.
     *
     */
    public function showAction(Oeuvre $oeuvre)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($oeuvre);

        return $this->render('oeuvre/show.html.twig', array(
            'oeuvre' => $oeuvre,
            'delete_form' => $deleteForm->createView(),
            'role'   => $role,
        ));
    }

    /**
     * Displays a form to edit an existing Oeuvre entity.
     *
     */
    public function editAction(Request $request, Oeuvre $oeuvre)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($oeuvre);
        $editForm = $this->createForm('ModuleGestionBundle\Form\OeuvreType', $oeuvre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oeuvre);
            $em->flush();

            return $this->redirectToRoute('oeuvre_edit', array(
                'id'   => $oeuvre->getId(),
                'role' => $role,
            ));
        }

        return $this->render('oeuvre/edit.html.twig', array(
            'oeuvre' => $oeuvre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'role'   => $role,
        ));
    }

    /**
     * Deletes a Oeuvre entity.
     *
     */
    public function deleteAction(Request $request, Oeuvre $oeuvre)
    {
        $form = $this->createDeleteForm($oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oeuvre);
            $em->flush();
        }

        return $this->redirectToRoute('oeuvre_index');
    }

    /**
     * Creates a form to delete a Oeuvre entity.
     *
     * @param Oeuvre $oeuvre The Oeuvre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oeuvre $oeuvre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oeuvre_delete', array('id' => $oeuvre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
