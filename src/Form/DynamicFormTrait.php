<?php

namespace Softspring\Component\DynamicFormType\Form;

use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

trait DynamicFormTrait
{
    public function configureDynamicFormOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('form_fields');
        $resolver->setAllowedTypes('form_fields', 'array');
        $resolver->setDefault('form_fields', []);
    }

    public function buildDynamicForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($options['form_fields'] as $fieldName => $formField) {
            $builder->add($fieldName, $this->getFieldType($formField['type'] ?? 'text'), $formField['type_options'] ?? []);
        }
    }

    protected function getFieldType(string $type): string
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
