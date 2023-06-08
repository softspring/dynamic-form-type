<?php

namespace Softspring\Component\DynamicFormType\Test\Form;

use Softspring\Component\DynamicFormType\Form\DynamicFormCollectionType;
use Softspring\Component\DynamicFormType\Form\Extension\DynamicFormExtension;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\TypeResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\TypeTestCase;

class DynamicFormCollectionTypeTest extends TypeTestCase
{
    protected function getExtensions(): array
    {
        $extensions = parent::getExtensions();

        $extensions[] = new DynamicFormExtension(new TypeResolver(), new ConstraintResolver());

        return $extensions;
    }

    public function testBasicCollection()
    {
        $this->markTestSkipped('Not yet ready');
        return;

        $config = [
            'entry_options' => [
                'form_fields' => [
                    'test' => [],
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormCollectionType::class, [
            ['test' => 'data'],
        ], $config);
        $view = $form->createView();

        $this->assertCount(1, $view->children);
        $this->assertArrayHasKey('test', $view->children[0]->children);
        $this->assertArrayHasKey('test', $form->get('0'));
        $this->assertEquals(TextType::class, get_class($form->get('0')->get('test')->getConfig()->getType()->getInnerType()));
        $this->assertEquals('data', $form->get('0')->get('test')->getData());
    }
}
