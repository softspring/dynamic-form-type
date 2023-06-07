<?php

namespace Softspring\Component\DynamicFormType\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DynamicFormType extends AbstractType implements DynamicFormTypeInterface
{
    use DynamicFormTrait;

    public function getBlockPrefix(): string
    {
        return 'dynamic_form';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $this->configureDynamicFormOptions($resolver);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->buildDynamicForm($builder, $options);
    }
}
