<?php

namespace LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class BookCopyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addedToLibraryAt', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
            ))
            ->add('edition', 'entity', array(
                'class' => 'LibraryBundle\Entity\BookEdition',
                'choice_label' => 'name',
                'empty_value' => 'Please choose an edition'
            ))
            ->add('reader', 'entity', array(
                'class' => 'LibraryBundle\Entity\Reader',
                'choice_label' => 'fullName',
                'required' => false,
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LibraryBundle\Entity\BookCopy'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'librarybundle_bookcopy';
    }
}
