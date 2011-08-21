<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DS\TxinbometroBundle\Entity\Gasto;
use DS\TxinbometroBundle\Form\GastoType;

/**
 * Gasto controller.
 *
 */
class GastoController extends Controller {

    /**
     * Lists all Gasto entities.
     *
     */
    public function indexAction() {
        $vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();

        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TxinbometroBundle:Gasto')->getAllFrom($vehiculo->getId());

        return $this->render('TxinbometroBundle:Gasto:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Gasto entity.
     *
     */
    public function showAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasto entity.');
        }

        if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Gasolina entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Gasto:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Gasto entity.
     *
     */
    public function newAction() {
        $entity = new Gasto();
        $form = $this->createForm(new GastoType(), $entity);

        return $this->render('TxinbometroBundle:Gasto:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new Gasto entity.
     *
     */
    public function createAction() {
        $vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();

        $entity = new Gasto();
        $request = $this->getRequest();
        $form = $this->createForm(new GastoType(), $entity);
        $form->bindRequest($request);

        $entity->setVehiculo($vehiculo);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('txinbometro_gasto_show', array('id' => $entity->getId())));
        }

        return $this->render('TxinbometroBundle:Gasto:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Gasto entity.
     *
     */
    public function editAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasto entity.');
        }
        if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Gasolina entity.');
        }
        $editForm = $this->createForm(new GastoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Gasto:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Gasto entity.
     *
     */
    public function updateAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasto entity.');
        }

        if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Gasolina entity.');
        }

        $editForm = $this->createForm(new GastoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('txinbometro_gasto_edit', array('id' => $id)));
        }

        return $this->render('TxinbometroBundle:Gasto:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gasto entity.
     *
     */
    public function deleteAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TxinbometroBundle:Gasto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gasto entity.');
            }
            if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
                throw $this->createNotFoundException('Unable to access Gasolina entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('txinbometro_gasto'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                ->add('id', 'hidden')
                ->getForm()
        ;
    }

}
