<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Royopa\SicinBundle\Entity\Posicao;
use Royopa\SicinBundle\Form\PosicaoType;

/**
 * Posicao controller.
 *
 * @Route("/posicao")
 */
class PosicaoController extends Controller
{

    /**
     * Lists all Posicao entities.
     *
     * @Route("/", name="posicao")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RoyopaSicinBundle:Posicao')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Posicao entity.
     *
     * @Route("/", name="posicao_create")
     * @Method("POST")
     * @Template("RoyopaSicinBundle:Posicao:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Posicao();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('posicao_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Posicao entity.
    *
    * @param Posicao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Posicao $entity)
    {
        $form = $this->createForm(new PosicaoType(), $entity, array(
            'action' => $this->generateUrl('posicao_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Posicao entity.
     *
     * @Route("/new", name="posicao_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Posicao();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Posicao entity.
     *
     * @Route("/{id}", name="posicao_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:Posicao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Posicao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Posicao entity.
     *
     * @Route("/{id}/edit", name="posicao_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:Posicao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Posicao entity.');
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
    * Creates a form to edit a Posicao entity.
    *
    * @param Posicao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Posicao $entity)
    {
        $form = $this->createForm(new PosicaoType(), $entity, array(
            'action' => $this->generateUrl('posicao_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Posicao entity.
     *
     * @Route("/{id}", name="posicao_update")
     * @Method("PUT")
     * @Template("RoyopaSicinBundle:Posicao:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:Posicao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Posicao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('posicao_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Posicao entity.
     *
     * @Route("/{id}", name="posicao_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RoyopaSicinBundle:Posicao')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Posicao entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('posicao'));
    }

    /**
     * Creates a form to delete a Posicao entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('posicao_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
