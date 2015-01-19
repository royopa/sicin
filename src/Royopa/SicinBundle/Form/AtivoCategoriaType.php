<?php

namespace Royopa\SicinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AtivoCategoriaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nome',
                null,
                array(
                    'label' => 'Nome',
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control',
                        ),
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'Royopa\SicinBundle\Entity\AtivoCategoria']
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'royopa_sicinbundle_ativocategoria';
    }
}
