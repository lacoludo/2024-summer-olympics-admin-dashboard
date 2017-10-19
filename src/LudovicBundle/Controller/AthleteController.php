<?php

namespace LudovicBundle\Controller;

use LudovicBundle\Entity\Athlete;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Athlete controller.
 *
 * @Route("athlete")
 */
class AthleteController extends Controller
{
    /**
     * Lists all athlete entities.
     *
     * @Route("/", name="athlete_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $athletes = $em->getRepository('LudovicBundle:Athlete')->findAll();

        return $this->render('LudovicBundle:athlete:index.html.twig', array(
            'athletes' => $athletes,
        ));
    }

    /**
     * Creates a new athlete entity.
     *
     * @Route("/new", name="athlete_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $athlete = new Athlete();
        $form = $this->createForm('LudovicBundle\Form\AthleteType', $athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $profilePicture stores the uploaded image file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $profilePicture */
            $profilePicture = $athlete->getPhoto();

            // Generate a unique name for the file before saving it
            $profilePictureName = md5(uniqid()).'.'.$profilePicture->guessExtension();

            // Move the file to the directory where photos are stored
            $profilePicture->move(
                $this->getParameter('photos_directory'),
                $profilePictureName
            );

            // Update the 'photo' property to store the image file name
            // instead of its contents
            $athlete->setPhoto($profilePictureName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($athlete);
            $em->flush();
            // ... persist the $photo variable or any other work

            $this->addFlash("success", "Athlete created");

            return $this->redirectToRoute('athlete_show', array('id' => $athlete->getId()));
        }

        return $this->render('LudovicBundle:athlete:new.html.twig', array(
            'athlete' => $athlete,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a athlete entity.
     *
     * @Route("/{id}", name="athlete_show")
     * @Method("GET")
     */
    public function showAction(Athlete $athlete)
    {
        $deleteForm = $this->createDeleteForm($athlete);

        return $this->render('LudovicBundle:athlete:show.html.twig', array(
            'athlete' => $athlete,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing athlete entity.
     *
     * @Route("/{id}/edit", name="athlete_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Athlete $athlete)
    {
        $deleteForm = $this->createDeleteForm($athlete);
        $editForm = $this->createForm('LudovicBundle\Form\AthleteType', $athlete);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('athlete_edit', array('id' => $athlete->getId()));
        }

        return $this->render('LudovicBundle:athlete:edit.html.twig', array(
            'athlete' => $athlete,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a athlete entity.
     *
     * @Route("/{id}", name="athlete_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Athlete $athlete)
    {
        $form = $this->createDeleteForm($athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($athlete);
            $em->flush();
        }

        $this->addFlash("success", "Athlete deleted");

        return $this->redirectToRoute('athlete_index');
    }

    /**
     * Creates a form to delete a athlete entity.
     *
     * @param Athlete $athlete The athlete entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Athlete $athlete)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('athlete_delete', array('id' => $athlete->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
