<?php

namespace Softspring\Component\DynamicFormType\Form\Resolver;

use Symfony\Component\Form\Exception\InvalidConfigurationException;

class ConstraintResolver implements ConstraintResolverInterface
{
    public function resolveConstraintClass(string $constraint): string
    {
        if (class_exists($constraint)) {
            return $constraint;
        }

        $posibleClasses = $this->getConstraintClasses($constraint);

        foreach ($posibleClasses as $posibleClass) {
            if (class_exists($posibleClass)) {
                return $posibleClass;
            }
        }

        throw new InvalidConfigurationException(sprintf("Constraint '%s' not found in dynamic form.\n\nSearched paths were %s. \n\nYou can try to configure as full namespaced class (example: App\Validator\Constraints\MyCustomConstraint)", $constraint, implode(', ', $posibleClasses)));
    }

    protected function getConstraintClasses(string $type): array
    {
        return [
            'App\Validator\Constraints\\'.ucfirst($type),
            'Symfony\Component\Validator\Constraints\\'.ucfirst($type),
        ];
    }
}
