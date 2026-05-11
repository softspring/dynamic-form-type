<?php

declare(strict_types=1);

namespace Softspring\Component\DynamicFormType\Form\Type;

use Symfony\Component\Form\AbstractType;

class DynamicFormType extends AbstractType implements DynamicFormTypeInterface
{
    public function getBlockPrefix(): string
    {
        return 'dynamic_form';
    }
}
