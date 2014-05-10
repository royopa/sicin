<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Royopa\SicinBundle\Entity\TaxaTipo;
use Royopa\SicinBundle\Form\TaxaTipoType;

/**
 * TaxaTipo controller.
 *
 * @Route("/taxa_tipo")
 */
class TaxaTipoController extends Controller
{

    /**
     * Lists all TaxaTipo entities.
     *
     * @Route("/", name="taxa_tipo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RoyopaSicinBundle:TaxaTipo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TaxaTipo entity.
     *
     * @Route("/", name="taxa_tipo_create")
     * @Method("POST")
     * @Template("RoyopaSicinBundle:TaxaTipo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TaxaTipo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taxa_tipo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a TaxaTipo entity.
    *
    * @param TaxaTipo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TaxaTipo $entity)
    {
        $form = $this->createForm(new TaxaTipoType(), $entity, array(
            'action' => $this->generateUrl('taxa_tipo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TaxaTipo entity.
     *
     * @Route("/new", name="taxa_tipo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TaxaTipo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TaxaTipo entity.
     *
     * @Route("/{id}", name="taxa_tipo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:TaxaTipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TaxaTipo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TaxaTipo entity.
     *
     * @Route("/{id}/edit", name="taxa_tipo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:TaxaTipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TaxaTipo entity.');
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
    * Creates a form to edit a TaxaTipo entity.
    *
    * @param TaxaTipo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TaxaTipo $entity)
    {
        $form = $this->createForm(new TaxaTipoType(), $entity, array(
            'action' => $this->generateUrl('taxa_tipo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TaxaTipo entity.
     *
     * @Route("/{id}", name="taxa_tipo_update")
     * @Method("PUT")
     * @Template("RoyopaSicinBundle:TaxaTipo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:TaxaTipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TaxaTipo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('taxa_tipo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TaxaTipo entity.
     *
     * @Route("/{id}", name="taxa_tipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RoyopaSicinBundle:TaxaTipo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TaxaTipo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('taxa_tipo'));
    }

    /**
     * Creates a form to delete a TaxaTipo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('taxa_tipo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
