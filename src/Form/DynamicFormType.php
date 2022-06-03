<?php

namespace Softspring\Component\DynamicFormType\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DynamicFormType extends AbstractType
{
    use DynamicFormTrait;

    public function getBlockPrefix(): string
    {
        return 'dynamic_form';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $this->configureDynamicFormOptions($resolver);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildDynamicForm($builder, $options);
    }
}
