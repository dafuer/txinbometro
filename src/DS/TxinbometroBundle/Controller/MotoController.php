<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DS\TxinbometroBundle\Entity\Moto;
use DS\TxinbometroBundle\Form\MotoType;

/**
 * Moto controller.
 *
 */
class MotoController extends Controller
{
    /**
     * Lists all Moto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TxinbometroBundle:Moto')->findAll();

        return $this->render('TxinbometroBundle:Moto:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Moto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Moto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Moto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Moto entity.
     *
     */
    public function newAction()
    {
        $entity = new Moto();
        $form   = $this->createForm(new MotoType(), $entity);

        return $this->render('TxinbometroBundle:Moto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Moto entity.
     *
     */
    public function createAction()
    {
        $entity  = new Moto();
        $request = $this->getRequest();
        $form    = $this->createForm(new MotoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('moto_show', array('id' => $entity->getId())));
            
        }

        return $this->render('TxinbometroBundle:Moto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Moto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Moto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moto entity.');
        }

        $editForm = $this->createForm(new MotoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Moto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Moto entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Moto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moto entity.');
        }

        $editForm   = $this->createForm(new MotoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('moto_edit', array('id' => $id)));
        }

        return $this->render('TxinbometroBundle:Moto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Moto entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TxinbometroBundle:Moto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Moto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('moto'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
