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
            ->add(
                'instituicaoFinanceira',
                null,
                array(
                'label' => 'Instituicao Financeira',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control select2',
                    ),
                )
            )
            ->add(
                'ativo',
                null,
                array(
                'label' => 'Ativo',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control select2',
                    ),
                )
            )
            ->add(
                'dataReferencia',
                'date',
                array(
                    'label' => 'Data de Referência',
                    'required' => true,
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'form-control datepicker',
                    ),
                )
            )
            ->add(
                'quantidade',
                null,
                array(
                    'label' => 'Quantidade',
                    'grouping' => true,
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                )
            )
            ->add(
                'valorBrutoTotal',
                null,
                array(
                    'label' => 'Custo Total',
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                )
            )
            ->add(
                'valorLiquidoTotal',
                null,
                array(
                    'label' => 'Valor Líquido Total',
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                )
            )
            ->add(
                'valorMercado',
                null,
                array(
                    'label' => 'Valor Mercado',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                )
            )
            ->add(
                'valorProvento',
                null,
                array(
                    'label' => 'Valor Proventos',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'attr'     => array(
                        'class' => 'btn btn-default',
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
        $resolver->setDefaults(
            array(
                'data_class' => 'Royopa\SicinBundle\Entity\Posicao',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'royopa_sicinbundle_posicao';
    }
}
