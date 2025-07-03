<?php

namespace Softspring\Component\DynamicFormType\Form\Extension\Type;

use Softspring\Component\DynamicFormType\Form\DynamicFormType as DeprecatedDynamicFormType;
use Softspring\Component\DynamicFormType\Form\DynamicFormTypeInterface as DeprecatedDynamicFormTypeInterface;
use Softspring\Component\DynamicFormType\Form\Resolver\TypeResolverInterface;
use Softspring\Component\DynamicFormType\Form\Type\DynamicFormType;
use Softspring\Component\DynamicFormType\Form\Type\DynamicFormTypeInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DynamicTypesExtension extends AbstractTypeExtension
{
    protected TypeResolverInterface $typeResolver;

    public function __construct(TypeResolverInterface $typeResolver)
    {
        $this->typeResolver = $typeResolver;
    }

    public static function getExtendedTypes(): iterable
    {
        return [
            DynamicFormTypeInterface::class, DynamicFormType::class,
            DeprecatedDynamicFormTypeInterface::class, DeprecatedDynamicFormType::class,
        ];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('form_fields');
        $resolver->setAllowedTypes('form_fields', 'array');
        $resolver->setDefault('form_fields', []);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($options['form_fields'] as $fieldName => $formField) {
            $builder->add($fieldName, $this->typeResolver->resolveTypeClass($formField['type'] ?? 'text'), $formField['type_options'] ?? []);
        }
    }
}
