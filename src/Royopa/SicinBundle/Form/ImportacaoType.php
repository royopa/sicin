<?php
/*
 * This file is part of the Gerat Bundle.
 *
 * (c) Rodrigo Prado de Jesus <rodrigo.p.jesus@caixa.gov.br>
 *
 */
namespace Royopa\SicinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ImportacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attachment', 'file', array(
                'label'    => 'Arquivo*',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    ),
                ))
            ->add('submit', 'submit', array(
                'label'    => 'Importar',
                'attr'     => array(
                    'class'=> 'btn btn-default'
                    )
                ))
            ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'royopa_sicinbundle_importacao';
    }
}
