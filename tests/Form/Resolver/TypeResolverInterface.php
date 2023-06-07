<?php

namespace Softspring\Component\DynamicFormType\Form\Resolver;

interface TypeResolverInterface
{
    public function resolveTypeClass(string $type): string;
}
