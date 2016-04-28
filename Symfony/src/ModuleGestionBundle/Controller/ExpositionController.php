<?php

namespace ModuleGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ModuleGestionBundle\Entity\Exposition;
use ModuleGestionBundle\Form\ExpositionType;

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
        $em = $this->getDoctrine()->getManager();

        $expositions = $em->getRepository('ModuleGestionBundle:Exposition')->findAll();

        return $this->render('exposition/index.html.twig', array(
            'expositions' => $expositions,
        ));
    }

    /**
     * Creates a new Exposition entity.
     *
     */
    public function newAction(Request $request)
    {
        $exposition = new Exposition();
        $form = $this->createForm('ModuleGestionBundle\Form\ExpositionType', $exposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exposition);
            $em->flush();

            return $this->redirectToRoute('exposition_show', array('id' => $exposition->getId()));
        }

        return $this->render('exposition/new.html.twig', array(
            'exposition' => $exposition,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Exposition entity.
     *
     */
    public function showAction(Exposition $exposition)
    {
        $deleteForm = $this->createDeleteForm($exposition);

        return $this->render('exposition/show.html.twig', array(
            'exposition' => $exposition,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Exposition entity.
     *
     */
    public function editAction(Request $request, Exposition $exposition)
    {
        $deleteForm = $this->createDeleteForm($exposition);
        $editForm = $this->createForm('ModuleGestionBundle\Form\ExpositionType', $exposition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exposition);
            $em->flush();

            return $this->redirectToRoute('exposition_edit', array('id' => $exposition->getId()));
        }

        return $this->render('exposition/edit.html.twig', array(
            'exposition' => $exposition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Exposition entity.
     *
     */
    public function deleteAction(Request $request, Exposition $exposition)
    {
        $form = $this->createDeleteForm($exposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($exposition);
            $em->flush();
        }

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
