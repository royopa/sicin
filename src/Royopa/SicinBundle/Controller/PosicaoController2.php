<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Royopa\SicinBundle\Entity\Posicao;
use Royopa\SicinBundle\Form\PosicaoType;
use Royopa\SicinBundle\Form\ConsultaDataType;

/**
 * Posicao controller.
 *
 * @Route("/posicao")
 * @Security("has_role('ROLE_ADMIN')") 
 */
class PosicaoController extends Controller
{
    /**
     * Lists all Posicao sintética entities.
     *
     * @Route("/sintetica", name="posicao_sintetica")
     * @Method({"POST","GET"})
     * @Template()
     */
    public function sinteticaIndexAction(Request $request)
    {
        $form = $this->createForm(new ConsultaDataType(), null, array(
            'action' => $this->generateUrl('posicao_sintetica'),
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {

            $data = $form->getData();

            $dataReferencia = $data['date'];

            $em = $this->getDoctrine()->getManager();

            $entities =
                $em
                    ->getRepository('RoyopaSicinBundle:Posicao')
                    ->findPosicaoSintetica($dataReferencia);

            //$entities = $em->getRepository('RoyopaSicinBundle:Posicao')->findAll();

            $valorBrutoTotal    = 0;
            $valorLiquidoTotal  = 0;
            $valorAplicadoMes   = 0;
            $valorRendimentoMes = 0;

            foreach ($entities as $posicao) {
                $posicaoAnterior = $em->getRepository('RoyopaSicinBundle:Posicao')->getPosicaoAnterior($posicao);
                $posicao->setPosicaoAnterior($posicaoAnterior);

                $valorBrutoTotal    = $valorBrutoTotal + $posicao->getValorBrutoTotal();
                $valorLiquidoTotal  = $valorLiquidoTotal + $posicao->getValorLiquidoTotal();
                $valorAplicadoMes   = $valorAplicadoMes + $posicao->getValorAplicadoMes();
                $valorRendimentoMes = $valorRendimentoMes + $posicao->getValorRendimentoMes();
            }

            return $this->render('RoyopaSicinBundle:Posicao:sintetica_list.html.twig', array(
                'dataReferencia'     => $dataReferencia,
                'entities'           => $entities,
                'valorBrutoTotal'    => $valorBrutoTotal,
                'valorLiquidoTotal'  => $valorLiquidoTotal,
                'valorAplicadoMes'   => $valorAplicadoMes,
                'valorRendimentoMes' => $valorRendimentoMes
            ));

        }

        return $this->render('RoyopaSicinBundle:Form:form_consulta_data.html.twig', array(
            'title'    => 'Consulta posição sintética de investimentos',
            'subtitle' => 'Utilize o formulário abaixo para consultar a posição sintética de investimentos.',
            'form'     => $form->createView(),
        ));
    }

    /**
     * Lists all Posicao entities.
     *
     * @Route("/", name="posicao")
     * @Method({"POST","GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new ConsultaDataType(), null, array(
            'action' => $this->generateUrl('posicao'),
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {

            $data = $form->getData();

            $dataReferencia = $data['date'];

            $em = $this->getDoctrine()->getManager();

            $entities =
                $em
                    ->getRepository('RoyopaSicinBundle:Posicao')
                    ->findByDataReferencia($dataReferencia);

            //$entities = $em->getRepository('RoyopaSicinBundle:Posicao')->findAll();

            $valorBrutoTotal    = 0;
            $valorLiquidoTotal  = 0;
            $valorAplicadoMes   = 0;
            $valorRendimentoMes = 0;

            foreach ($entities as $posicao) {
                $posicaoAnterior = $em->getRepository('RoyopaSicinBundle:Posicao')->getPosicaoAnterior($posicao);
                $posicao->setPosicaoAnterior($posicaoAnterior);

                $valorBrutoTotal    = $valorBrutoTotal + $posicao->getValorBrutoTotal();
                $valorLiquidoTotal  = $valorLiquidoTotal + $posicao->getValorLiquidoTotal();
                $valorAplicadoMes   = $valorAplicadoMes + $posicao->getValorAplicadoMes();
                $valorRendimentoMes = $valorRendimentoMes + $posicao->getValorRendimentoMes();
            }

            return $this->render('RoyopaSicinBundle:Posicao:index.html.twig', array(
                'dataReferencia'     => $dataReferencia,
                'entities'           => $entities,
                'valorBrutoTotal'    => $valorBrutoTotal,
                'valorLiquidoTotal'  => $valorLiquidoTotal,
                'valorAplicadoMes'   => $valorAplicadoMes,
                'valorRendimentoMes' => $valorRendimentoMes
            ));

        }

        return $this->render('RoyopaSicinBundle:Form:form_consulta_data.html.twig', array(
            'title'    => 'Consulta posição de investimentos',
            'subtitle' => 'Utilize o formulário abaixo para consultar a posição de investimetnos na data solicitada.',
            'form'     => $form->createView(),
        ));
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

            var_dump($entity);
            
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
     * @Route("/{id}/show", name="posicao_show")
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
            'form'   => $editForm->createView(),
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

            $this->get('session')->getFlashBag()->add(
                'success',
                'Posição alterada com sucesso'
            );

            return $this->redirect($this->generateUrl('posicao_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
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

    /**
     * Gets the last position for ativo.
     *
     * @Route("/get_ultima_posicao", name="get_ultima_posicao")
     * @Method("GET")
     */
    public function getUltimaPosicaoAction(Request $request)
    {
        $if_id    = $request->query->get('if_id');
        $ativo_id = $request->query->get('ativo_id');

        $em =  $this->get('doctrine')->getManager();

        $connection = $em->getConnection();

        $statement = $connection->prepare(
            "
            SELECT
                vr_bruto_total,
                quantidade
            FROM
                POSICAO
            WHERE
                if_id = :if_id AND
                ativo_id = :ativo_id
            ORDER BY
                dt_referencia
            DESC
            LIMIT
                1
            "
        );

        $statement->bindValue('if_id', $if_id);
        $statement->bindValue('ativo_id', $ativo_id);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $data = array(
                'vr_bruto_total' => number_format($row['vr_bruto_total'],2,",",""),
                'quantidade' => number_format($row['quantidade'],0,",","")
                );
        }

        // create a JSON-response with a 200 status code
        $response = new JsonResponse($data);

        if ($request->query->get('callback')) {
            $response->setCallback($request->query->get('callback'));
        }

        return $response;
    }
}
