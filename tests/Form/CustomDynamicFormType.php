<?php

namespace Softspring\Component\DynamicFormType\Test\Form;

use Softspring\Component\DynamicFormType\Form\DynamicFormType;

class CustomDynamicFormType extends DynamicFormType
{
    protected function getFormClasses(string $type): array
    {
        return [
            'App\Form\Type\\'.ucfirst($type).'Type',
            'Softspring\Component\DynamicFormType\Test\Form\\'.ucfirst($type).'Type',
            'Symfony\Component\Form\Extension\Core\Type\\'.ucfirst($type).'Type',
        ];
    }
}
