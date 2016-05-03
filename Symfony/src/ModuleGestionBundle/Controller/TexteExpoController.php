<?php

namespace ModuleGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ModuleGestionBundle\Entity\TexteExpo;
use ModuleGestionBundle\Form\TexteExpoType;

/**
 * TexteExpo controller.
 *
 */
class TexteExpoController extends Controller
{
    /**
     * Lists all TexteExpo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $texteExpos = $em->getRepository('ModuleGestionBundle:TexteExpo')->findAll();

        return $this->render('texteexpo/index.html.twig', array(
            'texteExpos' => $texteExpos,
        ));
    }

    /**
     * Creates a new TexteExpo entity.
     *
     */
    public function newAction(Request $request)
    {
        $texteExpo = new TexteExpo();
        $form = $this->createForm('ModuleGestionBundle\Form\TexteExpoType', $texteExpo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($texteExpo);
            $em->flush();

            return $this->redirectToRoute('texteexpo_show', array('id' => $texteExpo->getId()));
        }

        return $this->render('texteexpo/new.html.twig', array(
            'texteExpo' => $texteExpo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TexteExpo entity.
     *
     */
    public function showAction(TexteExpo $texteExpo)
    {
        $deleteForm = $this->createDeleteForm($texteExpo);

        return $this->render('texteexpo/show.html.twig', array(
            'texteExpo' => $texteExpo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TexteExpo entity.
     *
     */
    public function editAction(Request $request, TexteExpo $texteExpo)
    {
        $deleteForm = $this->createDeleteForm($texteExpo);
        $editForm = $this->createForm('ModuleGestionBundle\Form\TexteExpoType', $texteExpo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($texteExpo);
            $em->flush();

            return $this->redirectToRoute('texteexpo_edit', array('id' => $texteExpo->getId()));
        }

        return $this->render('texteexpo/edit.html.twig', array(
            'texteExpo' => $texteExpo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TexteExpo entity.
     *
     */
    public function deleteAction(Request $request, TexteExpo $texteExpo)
    {
        $form = $this->createDeleteForm($texteExpo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($texteExpo);
            $em->flush();
        }

        return $this->redirectToRoute('texteexpo_index');
    }

    /**
     * Creates a form to delete a TexteExpo entity.
     *
     * @param TexteExpo $texteExpo The TexteExpo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TexteExpo $texteExpo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('texteexpo_delete', array('id' => $texteExpo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
