<?php

namespace DS\TxinbometroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DS\TxinbometroBundle\Entity\Vehiculo;
use DS\TxinbometroBundle\Form\VehiculoType;

/**
 * Vehiculo controller.
 *
 */
class VehiculoController extends Controller {

    /**
     * Selecciona el vehiculo como el vehiculo de trabajo actual
     *
     */
    public function selectAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Vehiculo')->find($id);

        if ($entity->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Vehiculo entity.');
        }        
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }


        $usuario->setVehiculo($entity);

        $em->persist($usuario);

        $em->flush();

        // Ahora guardo en las variables de sesion tanto el vehiculo como sus consumos procesados
        $sesion=$this->get('session');
        $sesion->set('vehiculo',$entity);
        
        $consumoObject=$em->getRepository('TxinbometroBundle:Gasolina')->getConsumos($entity);
        $sesion->set('resumenConsumo',$consumoObject);
        
        
        return $this->redirect($this->generateUrl('txinbometro_estadisticas_general'));
    }

    public function cargarAction() {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $vehiculo = $usuario->getVehiculo();

        if ($vehiculo == null) {
            return $this->redirect($this->generateUrl('txinbometro_vehiculo'));
        } else {   
            return $this->forward('TxinbometroBundle:Vehiculo:select', array('id' => $vehiculo->getId()));
        }
    }

    /**
     * Lists all Vehiculo entities.
     *
     */
    public function indexAction() {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        //$entities = $em->getRepository('TxinbometroBundle:Vehiculo')->findAll();
        $entities = $em->getRepository('TxinbometroBundle:Vehiculo')->getAllFrom($usuario->getId());

        return $this->render('TxinbometroBundle:Vehiculo:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Vehiculo entity.
     *
     */
    public function showAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Vehiculo')->find($id);

        if ($entity->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Vehiculo entity.');
        }
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }


        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Vehiculo:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Vehiculo entity.
     *
     */
    public function newAction() {
        $entity = new Vehiculo();
        $form = $this->createForm(new VehiculoType(), $entity);

        return $this->render('TxinbometroBundle:Vehiculo:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new Vehiculo entity.
     *
     */
    public function createAction() {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $entity = new Vehiculo();
        $request = $this->getRequest();
        $form = $this->createForm(new VehiculoType(), $entity);

        $form->bindRequest($request);

        $entity->setUsuario($usuario);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('txinbometro_vehiculo_show', array('id' => $entity->getId())));
        }

        return $this->render('TxinbometroBundle:Vehiculo:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Vehiculo entity.
     *
     */
    public function editAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Vehiculo')->find($id);

        if ($entity->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Vehiculo entity.');
        }
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }


        $editForm = $this->createForm(new VehiculoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TxinbometroBundle:Vehiculo:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Vehiculo entity.
     *
     */
    public function updateAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TxinbometroBundle:Vehiculo')->find($id);

        if ($entity->getUsuario()->getId() != $usuario->getId()) {
            throw $this->createNotFoundException('Unable to access Vehiculo entity.');
        }
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }

        $editForm = $this->createForm(new VehiculoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        $entity->setUsuario($usuario);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('txinbometro_vehiculo_edit', array('id' => $id)));
        }

        return $this->render('TxinbometroBundle:Vehiculo:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vehiculo entity.
     *
     */
    public function deleteAction($id) {
        $usuario = $this->container->get('security.context')->getToken()->getUser();

        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TxinbometroBundle:Vehiculo')->find($id);

            if ($entity->getUsuario()->getId() != $usuario->getId()) {
                throw $this->createNotFoundException('Unable to access Vehiculo entity.');
            }
            
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vehiculo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('txinbometro_vehiculo'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                ->add('id', 'hidden')
                ->getForm()
        ;
    }

}
