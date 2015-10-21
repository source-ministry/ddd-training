<?php

namespace LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookEditionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isbn')
            ->add('name')
            ->add('author')
            ->add('releaseDate', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
            ))
            ->add('numberOfPages')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LibraryBundle\Entity\BookEdition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'librarybundle_bookedition';
    }
}
