<?php

namespace Softspring\Component\DynamicFormType\Form;

use Symfony\Component\Form\AbstractType;

class DynamicFormType extends AbstractType implements DynamicFormTypeInterface
{
    public function getBlockPrefix(): string
    {
        return 'dynamic_form';
    }
}
