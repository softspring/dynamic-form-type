<?php

namespace Softspring\Component\DynamicFormType\Form\Extension;

use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolverInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;

class DynamicConstraintsExtension extends AbstractTypeExtension
{
    protected ConstraintResolverInterface $constraintResolver;

    public function __construct(ConstraintResolverInterface $constraintResolver)
    {
        $this->constraintResolver = $constraintResolver;
    }

    public static function getExtendedTypes(): iterable
    {
        return [FormType::class];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setAllowedTypes('constraints', [Constraint::class, Constraint::class.'[]', 'array']);
        $resolver->setNormalizer('constraints', function (Options $options, $constraints) {
            if (is_object($constraints)) {
                return [$constraints];
            }

            if (empty($constraints)) {
                return [];
            }

            $constraints = (array) $constraints;

            foreach ($constraints as $constraint) {
                if ($constraint instanceof Constraint) {
                    $constraints[] = $constraint;
                }

                if (isset($constraint['constraint'])) {
                    $constraintClass = $this->constraintResolver->resolveConstraintClass($constraint['constraint']);
                    $constraints[] = new $constraintClass($constraint['options'] ?? []);
                } else {
                    throw new InvalidOptionsException('Constraints option allows Constraint objects or {constraint:string, options: []}');
                }
            }

            return $constraints;
        });
    }
}
