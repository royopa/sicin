<?php

namespace Royopa\SicinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PosicaoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('instituicaoFinanceira')
            ->add('ativo')
            ->add('dataReferencia')
            ->add('quantidade')
            ->add('valorMercado')
            ->add('valorBrutoTotal')
            ->add('valorLiquidoTotal')
            ->add('valorRendimentoTotal')
            ->add('percentualRendimentoTotal')
            ->add('valorProvento')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Royopa\SicinBundle\Entity\Posicao'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'royopa_sicinbundle_posicao';
    }
}
