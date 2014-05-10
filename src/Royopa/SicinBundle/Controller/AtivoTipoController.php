<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Royopa\SicinBundle\Entity\AtivoTipo;
use Royopa\SicinBundle\Form\AtivoTipoType;

/**
 * AtivoTipo controller.
 *
 * @Route("/ativo_tipo")
 */
class AtivoTipoController extends Controller
{

    /**
     * Lists all AtivoTipo entities.
     *
     * @Route("/", name="ativo_tipo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RoyopaSicinBundle:AtivoTipo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AtivoTipo entity.
     *
     * @Route("/", name="ativo_tipo_create")
     * @Method("POST")
     * @Template("RoyopaSicinBundle:AtivoTipo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AtivoTipo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ativo_tipo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a AtivoTipo entity.
    *
    * @param AtivoTipo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AtivoTipo $entity)
    {
        $form = $this->createForm(new AtivoTipoType(), $entity, array(
            'action' => $this->generateUrl('ativo_tipo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AtivoTipo entity.
     *
     * @Route("/new", name="ativo_tipo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AtivoTipo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AtivoTipo entity.
     *
     * @Route("/{id}", name="ativo_tipo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:AtivoTipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AtivoTipo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AtivoTipo entity.
     *
     * @Route("/{id}/edit", name="ativo_tipo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:AtivoTipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AtivoTipo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a AtivoTipo entity.
    *
    * @param AtivoTipo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AtivoTipo $entity)
    {
        $form = $this->createForm(new AtivoTipoType(), $entity, array(
            'action' => $this->generateUrl('ativo_tipo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AtivoTipo entity.
     *
     * @Route("/{id}", name="ativo_tipo_update")
     * @Method("PUT")
     * @Template("RoyopaSicinBundle:AtivoTipo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:AtivoTipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AtivoTipo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ativo_tipo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AtivoTipo entity.
     *
     * @Route("/{id}", name="ativo_tipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RoyopaSicinBundle:AtivoTipo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AtivoTipo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ativo_tipo'));
    }

    /**
     * Creates a form to delete a AtivoTipo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ativo_tipo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
