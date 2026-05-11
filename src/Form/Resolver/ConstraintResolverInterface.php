<?php

declare(strict_types=1);

namespace Softspring\Component\DynamicFormType\Form\Resolver;

interface ConstraintResolverInterface
{
    public function resolveConstraintClass(string $constraint): string;
}
