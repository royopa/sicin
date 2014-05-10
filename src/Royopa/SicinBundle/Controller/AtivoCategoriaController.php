<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Royopa\SicinBundle\Entity\AtivoCategoria;
use Royopa\SicinBundle\Form\AtivoCategoriaType;

/**
 * AtivoCategoria controller.
 *
 * @Route("/ativo_categoria")
 */
class AtivoCategoriaController extends Controller
{

    /**
     * Lists all AtivoCategoria entities.
     *
     * @Route("/", name="ativo_categoria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RoyopaSicinBundle:AtivoCategoria')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AtivoCategoria entity.
     *
     * @Route("/", name="ativo_categoria_create")
     * @Method("POST")
     * @Template("RoyopaSicinBundle:AtivoCategoria:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AtivoCategoria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ativo_categoria_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a AtivoCategoria entity.
    *
    * @param AtivoCategoria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AtivoCategoria $entity)
    {
        $form = $this->createForm(new AtivoCategoriaType(), $entity, array(
            'action' => $this->generateUrl('ativo_categoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AtivoCategoria entity.
     *
     * @Route("/new", name="ativo_categoria_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AtivoCategoria();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AtivoCategoria entity.
     *
     * @Route("/{id}", name="ativo_categoria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:AtivoCategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AtivoCategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AtivoCategoria entity.
     *
     * @Route("/{id}/edit", name="ativo_categoria_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:AtivoCategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AtivoCategoria entity.');
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
    * Creates a form to edit a AtivoCategoria entity.
    *
    * @param AtivoCategoria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AtivoCategoria $entity)
    {
        $form = $this->createForm(new AtivoCategoriaType(), $entity, array(
            'action' => $this->generateUrl('ativo_categoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AtivoCategoria entity.
     *
     * @Route("/{id}", name="ativo_categoria_update")
     * @Method("PUT")
     * @Template("RoyopaSicinBundle:AtivoCategoria:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:AtivoCategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AtivoCategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ativo_categoria_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AtivoCategoria entity.
     *
     * @Route("/{id}", name="ativo_categoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RoyopaSicinBundle:AtivoCategoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AtivoCategoria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ativo_categoria'));
    }

    /**
     * Creates a form to delete a AtivoCategoria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ativo_categoria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
