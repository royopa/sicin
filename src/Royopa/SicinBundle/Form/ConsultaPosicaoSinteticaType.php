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

class ConsultaPosicaoSinteticaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = new \DateTime('today');

        $builder
            ->add('mes', 'choice', array(
                'label'    => 'Mes*',
                'required' => true,
                'attr'     => array(
                    'class' => 'form-control',
                    'value' => $date->format('m'),
                    ),
                'constraints' => array(
                    new Assert\NotBlank(),
                    ),
                'choices' => array(
                    '01' => 'Jan',
                    '02' => 'Fev',
                    '03' => 'Mar',
                    '04' => 'Abr',
                    '05' => 'Mai',
                    '06' => 'Jun',
                    '07' => 'Jul',
                    '08' => 'Ago',
                    '09' => 'Set',
                    '10' => 'Out',
                    '11' => 'Nov',
                    '12' => 'Dez',
                    ),
                ))
            ->add('ano', 'choice', array(
                'label'    => 'Ano*',
                'required' => true,
                'attr'     => array(
                    'class' => 'form-control datepicker',
                    'value' => $date->format('Y'),
                    ),
                'constraints' => array(
                    new Assert\NotBlank(),
                    ),
                'choices' => array(
                    '2014'  => '2014',
                    '2015'  => '2015',
                    '2016'  => '2016',
                    ),
                ))
            ->add('submit', 'submit', array(
                'attr'     => array(
                    'class' => 'btn btn-default',
                    ),
                ))
            ;
    }

    public function getName()
    {
        return "sicin_form_posicao_sintetica";
    }
}
