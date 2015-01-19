<?php

namespace Royopa\SicinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AtivoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', null, array(
                'label' => 'Tipo',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    ),
                )
            )
            ->add('nome', null, array(
                'label' => 'Nome',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    ),
                )
            )
            ->add('codigo', null, array(
                'label' => 'Código',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    ),
                )
            )
            ->add('dataVencimento', 'date', array(
                'label' => 'Data de Vencimento',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'class' => 'form-control datepicker',
                    ),
                )
            )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Royopa\SicinBundle\Entity\Ativo',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'royopa_sicinbundle_ativo';
    }
}
