<?php

namespace LudovicBundle\Controller;

use LudovicBundle\Entity\Sport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sport controller.
 *
 * @Route("sport")
 */
class SportController extends Controller
{
    /**
     * Lists all sport entities.
     *
     * @Route("/", name="sport_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sports = $em->getRepository('LudovicBundle:Sport')->findAll();

        return $this->render('LudovicBundle:sport:index.html.twig', array(
            'sports' => $sports,
        ));
    }

    /**
     * Creates a new sport entity.
     *
     * @Route("/new", name="sport_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sport = new Sport();
        $form = $this->createForm('LudovicBundle\Form\SportType', $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sport);
            $em->flush();

            $this->addFlash("success", "Sport created");

            return $this->redirectToRoute('sport_show', array('id' => $sport->getId()));
        }

        return $this->render('LudovicBundle:sport:new.html.twig', array(
            'sport' => $sport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sport entity.
     *
     * @Route("/{id}", name="sport_show")
     * @Method("GET")
     */
    public function showAction(Sport $sport)
    {
        $deleteForm = $this->createDeleteForm($sport);

        return $this->render('LudovicBundle:sport:show.html.twig', array(
            'sport' => $sport,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sport entity.
     *
     * @Route("/{id}/edit", name="sport_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sport $sport)
    {
        $deleteForm = $this->createDeleteForm($sport);
        $editForm = $this->createForm('LudovicBundle\Form\SportType', $sport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sport_edit', array('id' => $sport->getId()));
        }

        return $this->render('LudovicBundle:sport:edit.html.twig', array(
            'sport' => $sport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sport entity.
     *
     * @Route("/{id}", name="sport_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sport $sport)
    {
        $form = $this->createDeleteForm($sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sport);
            $em->flush();
        }

        $this->addFlash("success", "Sport deleted");

        return $this->redirectToRoute('sport_index');
    }

    /**
     * Creates a form to delete a sport entity.
     *
     * @param Sport $sport The sport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sport $sport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sport_delete', array('id' => $sport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
