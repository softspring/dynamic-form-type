<?php

namespace Softspring\Component\DynamicFormType\Test\Resolver;

use Softspring\Component\DynamicFormType\Form\Resolver\TypeResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StubTypeResolver implements TypeResolverInterface
{
    public function resolveTypeClass(?string $type): ?string
    {
        if ('special' === $type) {
            return TextType::class;
        }

        return null;
    }

    public function getPossibleFormClasses(string $type): array
    {
        return [];
    }
}
