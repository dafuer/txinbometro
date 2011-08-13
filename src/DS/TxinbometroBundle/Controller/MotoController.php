<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DS\TxinbometroBundle\Entity\Moto;
use DS\TxinbometroBundle\Form\MotoType;

/**
 * Moto controller.
 *
 * @Route("/moto")
 */
class MotoController extends Controller
{
    /**
     * Lists all Moto entities.
     *
     * @Route("/", name="moto")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TxinbometroBundle:Moto')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Moto entity.
     *
     * @Route("/{id}/show", name="moto_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Moto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Moto entity.
     *
     * @Route("/new", name="moto_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Moto();
        $form   = $this->createForm(new MotoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Moto entity.
     *
     * @Route("/create", name="moto_create")
     * @Method("post")
     * @Template("TxinbometroBundle:Moto:new.html.twig")
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

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Moto entity.
     *
     * @Route("/{id}/edit", name="moto_edit")
     * @Template()
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

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Moto entity.
     *
     * @Route("/{id}/update", name="moto_update")
     * @Method("post")
     * @Template("TxinbometroBundle:Moto:edit.html.twig")
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

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Moto entity.
     *
     * @Route("/{id}/delete", name="moto_delete")
     * @Method("post")
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
