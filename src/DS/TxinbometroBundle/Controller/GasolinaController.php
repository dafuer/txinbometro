<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DS\TxinbometroBundle\Entity\Gasolina;
use DS\TxinbometroBundle\Form\GasolinaType;

/**
 * Gasolina controller.
 *
 */
class GasolinaController extends Controller {

    /**
     * Lists all Gasolina entities.
     *
     */
    public function indexAction() {
        $vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();

        if ($vehiculo==null) return $this->render("TxinbometroBundle:Default:primeroseleccionarvehiculo.html.twig");
        
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TxinbometroBundle:Gasolina')->getAllFrom($vehiculo->getId());

        return $this->render('TxinbometroBundle:Gasolina:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Gasolina entity.
     *
     */
    public function showAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);
        

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasolina entity.');
        }

        if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Gasolina entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Gasolina:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Gasolina entity.
     *
     */
    public function newAction() {
        $entity = new Gasolina();
        $form = $this->createForm(new GasolinaType(), $entity);

        return $this->render('TxinbometroBundle:Gasolina:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new Gasolina entity.
     *
     */
    public function createAction() {
        $vehiculo = $this->container->get('security.context')->getToken()->getUser()->getVehiculo();

        $entity = new Gasolina();
        $request = $this->getRequest();
        $form = $this->createForm(new GasolinaType(), $entity);
        $form->bindRequest($request);

        $entity->setVehiculo($vehiculo);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            // Anyado este codigo para actualizar la variable de sesion
            $consumoObject = $em->getRepository('TxinbometroBundle:Gasolina')->getConsumos($this->get('session')->get('vehiculo'));
            $this->get('session')->set('resumenConsumo', $consumoObject);

            return $this->redirect($this->generateUrl('txinbometro_gasolina_show', array('id' => $entity->getId())));
        }


        return $this->render('TxinbometroBundle:Gasolina:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Gasolina entity.
     *
     */
    public function editAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasolina entity.');
        }

        if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Gasolina entity.');
        }


        $editForm = $this->createForm(new GasolinaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Gasolina:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Gasolina entity.
     *
     */
    public function updateAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gasolina entity.');
        }

        if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Gasolina entity.');
        }

        $editForm = $this->createForm(new GasolinaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            // Anyado este codigo para actualizar la variable de sesion
            $consumoObject = $em->getRepository('TxinbometroBundle:Gasolina')->getConsumos($this->get('session')->get('vehiculo'));
            $this->get('session')->set('resumenConsumo', $consumoObject);
            return $this->redirect($this->generateUrl('txinbometro_gasolina_edit', array('id' => $id)));
        }

        return $this->render('TxinbometroBundle:Gasolina:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gasolina entity.
     *
     */
    public function deleteAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TxinbometroBundle:Gasolina')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gasolina entity.');
            }

            if ($entity->getVehiculo()->getUsuario()->getId() != $usuario->getId()) {
                throw $this->createNotFoundException('Unable to access Gasolina entity.');
            }
            $em->remove($entity);
            $em->flush();
        }

            // Anyado este codigo para actualizar la variable de sesion
            $consumoObject = $em->getRepository('TxinbometroBundle:Gasolina')->getConsumos($this->get('session')->get('vehiculo'));
            $this->get('session')->set('resumenConsumo', $consumoObject);

        return $this->redirect($this->generateUrl('txinbometro_gasolina'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                ->add('id', 'hidden')
                ->getForm()
        ;
    }

}
