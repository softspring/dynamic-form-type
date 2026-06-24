<?php

namespace Softspring\Component\DynamicFormType\Test\Resolver;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Softspring\Component\DynamicFormType\Form\Resolver\ChainTypeResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\DefaultTypeResolver;
use stdClass;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ResolverTest extends TestCase
{
    public function testDefaultTypeResolverReturnsNullForEmptyType(): void
    {
        self::assertNull((new DefaultTypeResolver())->resolveTypeClass(null));
    }

    public function testDefaultTypeResolverReturnsConfiguredClassName(): void
    {
        self::assertSame(TextType::class, (new DefaultTypeResolver())->resolveTypeClass(TextType::class));
    }

    public function testChainTypeResolverAllowsEmptyType(): void
    {
        self::assertNull((new ChainTypeResolver([new DefaultTypeResolver()]))->resolveTypeClass(null));
    }

    public function testChainTypeResolverRejectsInvalidResolvers(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('All resolvers must implement Softspring\Component\DynamicFormType\Form\Resolver\TypeResolverInterface interface.');

        new ChainTypeResolver([new stdClass()]);
    }

    public function testConstraintResolverReturnsConfiguredClassName(): void
    {
        self::assertSame(NotBlank::class, (new ConstraintResolver())->resolveConstraintClass(NotBlank::class));
    }

    public function testConstraintResolverReturnsSymfonyConstraintClass(): void
    {
        self::assertSame(NotBlank::class, (new ConstraintResolver())->resolveConstraintClass('notBlank'));
    }
}
