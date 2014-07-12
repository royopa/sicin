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

class ConsultaDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = new \DateTime('today');

        $builder
            ->add('date', 'date', array(
                'label'    => 'Data*',
                'required' => true,
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'attr'     => array(
                    'class' => 'form-control datepicker',
                    'value' => $date->format('d/m/Y')
                    ),
                'constraints' => array(
                    new Assert\NotBlank(),
                    ),
                ))
            ->add('submit', 'submit', array(
                'attr'     => array(
                    'class'=> 'btn btn-default'
                    )
                ))
            ;
    }

    /**
     * @var DateTime
     * Data de referência
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $date;

    /**
     * ConsultaDataType::getDate()
     *
     * @param void
     *
     * @return ConsultaDataType
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * ConsultaDataType::setDate()
     *
     * @param DateTime
     *
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function getName()
    {
        return "sicin_form_data";
    }
}
