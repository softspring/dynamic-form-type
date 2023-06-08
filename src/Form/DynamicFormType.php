<?php

namespace Softspring\Component\DynamicFormType\Form;

use Symfony\Component\Form\AbstractType;

class DynamicFormType extends AbstractType
{
    public function getBlockPrefix(): string
    {
        return 'dynamic_form';
    }
}
