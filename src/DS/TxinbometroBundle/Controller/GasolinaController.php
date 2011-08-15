<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DS\TxinbometroBundle\Entity\Gasolina;
use DS\TxinbometroBundle\Form\GasolinaType;

/**
 * Gasolina controller.
 *
 */
class GasolinaController extends Controller
{
    /**
     * Lists all Gasolina entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TxinbometroBundle:Gasolina')->findAll();

        return $this->render('TxinbometroBundle:Gasolina:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Gasolina entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasolina entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Gasolina:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Gasolina entity.
     *
     */
    public function newAction()
    {
        $entity = new Gasolina();
        $form   = $this->createForm(new GasolinaType(), $entity);

        return $this->render('TxinbometroBundle:Gasolina:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Gasolina entity.
     *
     */
    public function createAction()
    {
        $entity  = new Gasolina();
        $request = $this->getRequest();
        $form    = $this->createForm(new GasolinaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gasolina_show', array('id' => $entity->getId())));
            
        }

        return $this->render('TxinbometroBundle:Gasolina:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Gasolina entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasolina entity.');
        }

        $editForm = $this->createForm(new GasolinaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Gasolina:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Gasolina entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasolina entity.');
        }

        $editForm   = $this->createForm(new GasolinaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gasolina_edit', array('id' => $id)));
        }

        return $this->render('TxinbometroBundle:Gasolina:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gasolina entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gasolina entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gasolina'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
