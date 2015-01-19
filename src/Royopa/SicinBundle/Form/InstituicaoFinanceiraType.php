<?php

namespace Royopa\SicinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InstituicaoFinanceiraType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cnpj', null, array(
                'label' => 'CNPJ',
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
            ->add('link', null, array(
                'label' => 'Link',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
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
            'data_class' => 'Royopa\SicinBundle\Entity\InstituicaoFinanceira',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'royopa_sicinbundle_instituicaofinanceira';
    }
}
