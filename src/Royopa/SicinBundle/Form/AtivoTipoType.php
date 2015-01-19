<?php

namespace Royopa\SicinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AtivoTipoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoria', null, array(
                'label' => 'Categoria',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    ),
                )
            )
            ->add('taxa', null, array(
                'label' => 'Taxa',
                'required' => false,
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
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Royopa\SicinBundle\Entity\AtivoTipo',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'royopa_sicinbundle_ativotipo';
    }
}
