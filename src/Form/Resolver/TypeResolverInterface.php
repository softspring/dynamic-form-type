<?php

declare(strict_types=1);

namespace Softspring\Component\DynamicFormType\Form\Resolver;

interface TypeResolverInterface
{
    public function resolveTypeClass(?string $type): ?string;

    public function getPossibleFormClasses(string $type): array;
}
