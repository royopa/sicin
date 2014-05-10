<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Royopa\SicinBundle\Entity\Ativo;
use Royopa\SicinBundle\Form\AtivoType;

/**
 * Ativo controller.
 *
 * @Route("/ativo")
 */
class AtivoController extends Controller
{

    /**
     * Lists all Ativo entities.
     *
     * @Route("/", name="ativo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RoyopaSicinBundle:Ativo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Ativo entity.
     *
     * @Route("/", name="ativo_create")
     * @Method("POST")
     * @Template("RoyopaSicinBundle:Ativo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Ativo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ativo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Ativo entity.
    *
    * @param Ativo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Ativo $entity)
    {
        $form = $this->createForm(new AtivoType(), $entity, array(
            'action' => $this->generateUrl('ativo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ativo entity.
     *
     * @Route("/new", name="ativo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ativo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Ativo entity.
     *
     * @Route("/{id}", name="ativo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:Ativo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ativo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Ativo entity.
     *
     * @Route("/{id}/edit", name="ativo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:Ativo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ativo entity.');
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
    * Creates a form to edit a Ativo entity.
    *
    * @param Ativo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ativo $entity)
    {
        $form = $this->createForm(new AtivoType(), $entity, array(
            'action' => $this->generateUrl('ativo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ativo entity.
     *
     * @Route("/{id}", name="ativo_update")
     * @Method("PUT")
     * @Template("RoyopaSicinBundle:Ativo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:Ativo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ativo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ativo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Ativo entity.
     *
     * @Route("/{id}", name="ativo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RoyopaSicinBundle:Ativo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ativo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ativo'));
    }

    /**
     * Creates a form to delete a Ativo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ativo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
