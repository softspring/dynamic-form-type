<?php

namespace Softspring\Component\DynamicFormType\Form\Resolver;

use Symfony\Component\Form\Exception\InvalidConfigurationException;

class TypeResolver implements TypeResolverInterface
{
    public function resolveTypeClass(string $type): string
    {
        if (class_exists($type)) {
            return $type;
        }

        $posibleClasses = $this->getFormClasses($type);

        foreach ($posibleClasses as $posibleClass) {
            if (class_exists($posibleClass)) {
                return $posibleClass;
            }
        }

        throw new InvalidConfigurationException(sprintf("Type not found for '%s' in dynamic form.\n\nSearched paths were %s. \n\nYou can try to configure as full namespaced class (example: App\Form\Type\MyCustomType)", $type, implode(', ', $posibleClasses)));
    }

    protected function getFormClasses(string $type): array
    {
        return [
            'App\Form\Type\\'.ucfirst($type).'Type',
            'Symfony\Component\Form\Extension\Core\Type\\'.ucfirst($type).'Type',
        ];
    }
}
