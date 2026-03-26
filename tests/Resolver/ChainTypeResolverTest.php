<?php

namespace Softspring\Component\DynamicFormType\Test\Resolver;

use PHPUnit\Framework\TestCase;
use Softspring\Component\DynamicFormType\Form\Resolver\ChainTypeResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\DefaultTypeResolver;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChainTypeResolverTest extends TestCase
{
    public function testResolvesTypesFromConfiguredResolvers(): void
    {
        $resolver = new ChainTypeResolver([
            new StubTypeResolver(),
            new DefaultTypeResolver(),
        ]);

        self::assertSame(TextType::class, $resolver->resolveTypeClass('special'));
    }

    public function testThrowsClearExceptionForUnknownType(): void
    {
        $resolver = new ChainTypeResolver([new DefaultTypeResolver()]);

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessageMatches("/Type not found for 'invalid' in dynamic form./i");

        $resolver->resolveTypeClass('invalid');
    }
}
