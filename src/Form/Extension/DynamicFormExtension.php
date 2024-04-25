<?php

namespace Softspring\Component\DynamicFormType\Form\Extension;

use Softspring\Component\DynamicFormType\Form\Extension\Type\DynamicConstraintsExtension;
use Softspring\Component\DynamicFormType\Form\Extension\Type\DynamicTypesExtension;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolverInterface;
use Softspring\Component\DynamicFormType\Form\Resolver\TypeResolverInterface;
use Symfony\Component\Form\AbstractExtension;

class DynamicFormExtension extends AbstractExtension
{
    protected TypeResolverInterface $typeResolver;
    protected ConstraintResolverInterface $constraintResolver;

    public function __construct(TypeResolverInterface $typeResolver, ConstraintResolverInterface $constraintResolver)
    {
        $this->typeResolver = $typeResolver;
        $this->constraintResolver = $constraintResolver;
    }

    protected function loadTypeExtensions(): array
    {
        return [
            new DynamicTypesExtension($this->typeResolver),
            new DynamicConstraintsExtension($this->constraintResolver),
        ];
    }
}
