<?php

namespace Softspring\Component\DynamicFormType\Test\Form;

use Softspring\Component\DynamicFormType\Form\Extension\DynamicFormExtension;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\DefaultTypeResolver;
use Softspring\Component\DynamicFormType\Form\Type\DynamicFormCollectionType;
use Softspring\Component\DynamicFormType\Form\Type\DynamicFormType;
use Symfony\Component\Form\Test\Traits\ValidatorExtensionTrait;
use Symfony\Component\Form\Test\TypeTestCase;

class DynamicFormCollectionTypeTest extends TypeTestCase
{
    use ValidatorExtensionTrait;

    protected function getExtensions(): array
    {
        $extensions = parent::getExtensions();

        $extensions[] = new DynamicFormExtension(new DefaultTypeResolver(), new ConstraintResolver());

        return $extensions;
    }

    public function testBasicCollection(): void
    {
        $form = $this->factory->create(DynamicFormCollectionType::class);
        $options = $form->getConfig()->getOptions();

        self::assertSame(DynamicFormType::class, $options['entry_type']);
        self::assertTrue($options['allow_add']);
        self::assertTrue($options['allow_delete']);
        self::assertTrue($options['prototype']);
        self::assertSame(1, $options['prototype_initial_elements']);
    }
}
