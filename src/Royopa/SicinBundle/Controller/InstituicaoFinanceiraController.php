<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Royopa\SicinBundle\Entity\InstituicaoFinanceira;
use Royopa\SicinBundle\Form\InstituicaoFinanceiraType;

/**
 * InstituicaoFinanceira controller.
 *
 * @Route("/instituicao_financeira")
 */
class InstituicaoFinanceiraController extends Controller
{

    /**
     * Lists all InstituicaoFinanceira entities.
     *
     * @Route("/", name="instituicao_financeira")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new InstituicaoFinanceira entity.
     *
     * @Route("/", name="instituicao_financeira_create")
     * @Method("POST")
     * @Template("RoyopaSicinBundle:InstituicaoFinanceira:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new InstituicaoFinanceira();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('instituicao_financeira_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a InstituicaoFinanceira entity.
    *
    * @param InstituicaoFinanceira $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(InstituicaoFinanceira $entity)
    {
        $form = $this->createForm(new InstituicaoFinanceiraType(), $entity, array(
            'action' => $this->generateUrl('instituicao_financeira_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new InstituicaoFinanceira entity.
     *
     * @Route("/new", name="instituicao_financeira_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new InstituicaoFinanceira();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a InstituicaoFinanceira entity.
     *
     * @Route("/{id}", name="instituicao_financeira_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InstituicaoFinanceira entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing InstituicaoFinanceira entity.
     *
     * @Route("/{id}/edit", name="instituicao_financeira_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InstituicaoFinanceira entity.');
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
    * Creates a form to edit a InstituicaoFinanceira entity.
    *
    * @param InstituicaoFinanceira $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(InstituicaoFinanceira $entity)
    {
        $form = $this->createForm(new InstituicaoFinanceiraType(), $entity, array(
            'action' => $this->generateUrl('instituicao_financeira_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing InstituicaoFinanceira entity.
     *
     * @Route("/{id}", name="instituicao_financeira_update")
     * @Method("PUT")
     * @Template("RoyopaSicinBundle:InstituicaoFinanceira:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InstituicaoFinanceira entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('instituicao_financeira_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a InstituicaoFinanceira entity.
     *
     * @Route("/{id}", name="instituicao_financeira_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InstituicaoFinanceira entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('instituicao_financeira'));
    }

    /**
     * Creates a form to delete a InstituicaoFinanceira entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('instituicao_financeira_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
