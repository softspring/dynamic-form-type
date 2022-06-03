<?php

namespace Softspring\Component\DynamicFormType\Test\Form;

use Softspring\Component\DynamicFormType\Form\DynamicFormCollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\TypeTestCase;

class DynamicFormCollectionTypeTest extends TypeTestCase
{
    public function testBasicCollection()
    {
        $config = [
            'entry_options' => [
                'form_fields' => [
                    'test' => [],
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormCollectionType::class, [
            ['test' => 'data']
        ], $config);
        $view = $form->createView();

        $this->assertCount(1, $view->children);
        $this->assertArrayHasKey('test', $view->children[0]->children);
        $this->assertArrayHasKey('test', $form->get(0));
        $this->assertEquals(TextType::class, get_class($form->get(0)->get('test')->getConfig()->getType()->getInnerType()));
        $this->assertEquals('data', $form->get(0)->get('test')->getData());
    }
}
