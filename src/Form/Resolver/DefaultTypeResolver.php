<?php

namespace Softspring\Component\DynamicFormType\Form\Resolver;

class DefaultTypeResolver implements TypeResolverInterface
{
    public function resolveTypeClass(?string $type): ?string
    {
        if ($type && class_exists($type)) {
            return $type;
        }

        $posibleClasses = $type ? $this->getPossibleFormClasses($type) : [];

        foreach ($posibleClasses as $posibleClass) {
            if (class_exists($posibleClass)) {
                return $posibleClass;
            }
        }

        return null;
    }

    public function getPossibleFormClasses(string $type): array
    {
        return [
            'App\Form\Type\\'.ucfirst($type).'Type',
            'Softspring\Component\DynamicFormType\Form\Type\\'.ucfirst($type).'Type',
            'Symfony\Component\Form\Extension\Core\Type\\'.ucfirst($type).'Type',
            'Symfony\Bridge\Doctrine\Form\Type\\'.ucfirst($type).'Type',
        ];
    }
}
