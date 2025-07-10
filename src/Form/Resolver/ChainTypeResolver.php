<?php

namespace Softspring\Component\DynamicFormType\Form\Resolver;

use Symfony\Component\Form\Exception\InvalidConfigurationException;

class ChainTypeResolver implements TypeResolverInterface
{
    public function __construct(protected iterable $resolvers)
    {
        foreach ($resolvers as $resolver) {
            if (!$resolver instanceof TypeResolverInterface) {
                throw new \InvalidArgumentException(sprintf('All resolvers must implement %s interface.', TypeResolverInterface::class));
            }
        }
    }

    public function resolveTypeClass(?string $type): ?string
    {
        foreach ($this->resolvers as $resolver) {
            $resolvedType = $resolver->resolveTypeClass($type);
            if ($resolvedType !== null) {
                return $resolvedType;
            }
        }

        if ($type) {
            throw new InvalidConfigurationException(sprintf("Type not found for '%s' in dynamic form.\n\nSearched paths were %s. \n\nYou can try to configure as full namespaced class (example: App\Form\Type\MyCustomType)", $type, implode(', ', $this->getPossibleFormClasses($type))));
        }

        return null;
    }

    public function getPossibleFormClasses(string $type): array
    {
        $classes = [];
        foreach ($this->resolvers as $resolver) {
            if (method_exists($resolver, 'getPossibleFormClasses')) {
                $classes = array_merge($classes, $resolver->getPossibleFormClasses($type));
            }
        }
        return $classes;
    }
}