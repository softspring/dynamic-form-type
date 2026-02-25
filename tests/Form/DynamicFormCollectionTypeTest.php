<?php

namespace Softspring\Component\DynamicFormType\Test\Form;

use Softspring\Component\DynamicFormType\Form\DynamicFormCollectionType;
use Softspring\Component\DynamicFormType\Form\Extension\DynamicFormExtension;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\DefaultTypeResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\TypeTestCase;

class DynamicFormCollectionTypeTest extends TypeTestCase
{
    protected function getExtensions(): array
    {
        $extensions = parent::getExtensions();

        $extensions[] = new DynamicFormExtension(new DefaultTypeResolver(), new ConstraintResolver());

        return $extensions;
    }

    public function testBasicCollection(): void
    {
        $this->markTestSkipped('Not yet ready');
    }
}
