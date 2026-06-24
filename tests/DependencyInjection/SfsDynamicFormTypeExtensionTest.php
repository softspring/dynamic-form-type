<?php

namespace Softspring\Component\DynamicFormType\Test\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Softspring\Component\DynamicFormType\DependencyInjection\SfsDynamicFormTypeExtension;
use Softspring\Component\DynamicFormType\Form\Extension\Type\DynamicConstraintsExtension;
use Softspring\Component\DynamicFormType\Form\Extension\Type\DynamicTypesExtension;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolverInterface;
use Softspring\Component\DynamicFormType\Form\Resolver\DefaultTypeResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\TypeResolverInterface;
use Softspring\Component\DynamicFormType\SfsDynamicFormTypeBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SfsDynamicFormTypeExtensionTest extends TestCase
{
    public function testBundleReturnsPackagePath(): void
    {
        self::assertSame(\dirname(__DIR__, 2), (new SfsDynamicFormTypeBundle())->getPath());
    }

    public function testExtensionLoadsDynamicFormServices(): void
    {
        $container = new ContainerBuilder();

        (new SfsDynamicFormTypeExtension())->load([], $container);

        self::assertTrue($container->hasDefinition(DynamicConstraintsExtension::class));
        self::assertTrue($container->hasDefinition(DynamicTypesExtension::class));
        self::assertTrue($container->hasDefinition(DefaultTypeResolver::class));
        self::assertTrue($container->hasDefinition(ConstraintResolverInterface::class));
        self::assertTrue($container->hasDefinition(TypeResolverInterface::class));
        self::assertSame(ConstraintResolver::class, $container->getDefinition(ConstraintResolverInterface::class)->getClass());

        $constraintsDefinition = $container->getDefinition(DynamicConstraintsExtension::class);
        self::assertSame([['priority' => -200]], $constraintsDefinition->getTag('form.type_extension'));

        $defaultResolverDefinition = $container->getDefinition(DefaultTypeResolver::class);
        self::assertSame([['priority' => 0]], $defaultResolverDefinition->getTag('softspring.dynamic_form_type.type_resolver'));
    }
}
