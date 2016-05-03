<?php

namespace ModuleGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ModuleGestionBundle\Entity\TraductionExpo;
use ModuleGestionBundle\Form\TraductionExpoType;

/**
 * TraductionExpo controller.
 *
 */
class TraductionExpoController extends Controller
{
    /**
     * Lists all TraductionExpo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $traductionExpos = $em->getRepository('ModuleGestionBundle:TraductionExpo')->findAll();

        return $this->render('traductionexpo/index.html.twig', array(
            'traductionExpos' => $traductionExpos,
        ));
    }

    /**
     * Creates a new TraductionExpo entity.
     *
     */
    public function newAction(Request $request)
    {
        $traductionExpo = new TraductionExpo();
        $form = $this->createForm('ModuleGestionBundle\Form\TraductionExpoType', $traductionExpo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($traductionExpo);
            $em->flush();

            return $this->redirectToRoute('traductionexpo_show', array('id' => $traductionExpo->getId()));
        }

        return $this->render('traductionexpo/new.html.twig', array(
            'traductionExpo' => $traductionExpo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TraductionExpo entity.
     *
     */
    public function showAction(TraductionExpo $traductionExpo)
    {
        $deleteForm = $this->createDeleteForm($traductionExpo);

        return $this->render('traductionexpo/show.html.twig', array(
            'traductionExpo' => $traductionExpo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TraductionExpo entity.
     *
     */
    public function editAction(Request $request, TraductionExpo $traductionExpo)
    {
        $deleteForm = $this->createDeleteForm($traductionExpo);
        $editForm = $this->createForm('ModuleGestionBundle\Form\TraductionExpoType', $traductionExpo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($traductionExpo);
            $em->flush();

            return $this->redirectToRoute('traductionexpo_edit', array('id' => $traductionExpo->getId()));
        }

        return $this->render('traductionexpo/edit.html.twig', array(
            'traductionExpo' => $traductionExpo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TraductionExpo entity.
     *
     */
    public function deleteAction(Request $request, TraductionExpo $traductionExpo)
    {
        $form = $this->createDeleteForm($traductionExpo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($traductionExpo);
            $em->flush();
        }

        return $this->redirectToRoute('traductionexpo_index');
    }

    /**
     * Creates a form to delete a TraductionExpo entity.
     *
     * @param TraductionExpo $traductionExpo The TraductionExpo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TraductionExpo $traductionExpo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('traductionexpo_delete', array('id' => $traductionExpo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
