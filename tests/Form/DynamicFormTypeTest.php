<?php

namespace Softspring\Component\DynamicFormType\Test\Form;

use Softspring\Component\DynamicFormType\Form\DynamicFormType;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\TypeTestCase;

class DynamicFormTypeTest extends TypeTestCase
{
    public function testEmptyForm()
    {
        $config = [];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertCount(0, $view->children);
    }

    public function testFormWithFieldWithNoConfig()
    {
        $config = [
            'form_fields' => [
                'test' => [],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertArrayHasKey('test', $view->children);
        $this->assertEquals(TextType::class, get_class($form->get('test')->getConfig()->getType()->getInnerType()));
    }

    public function testFormWithTextField()
    {
        $config = [
            'form_fields' => [
                'test' => [
                    'type' => 'text',
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertArrayHasKey('test', $view->children);
        $this->assertEquals(TextType::class, get_class($form->get('test')->getConfig()->getType()->getInnerType()));
    }

    public function testFormWithTextFieldAndSomeOptions()
    {
        $config = [
            'form_fields' => [
                'test' => [
                    'type' => 'text',
                    'type_options' => [
                        'translation_domain' => 'custom',
                    ],
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertArrayHasKey('test', $view->children);
        $this->assertEquals(TextType::class, get_class($form->get('test')->getConfig()->getType()->getInnerType()));
        $this->assertEquals('custom', $form->get('test')->getConfig()->getOptions()['translation_domain']);
    }

    public function testFormWithMultipleFields()
    {
        $config = [
            'form_fields' => [
                'test1' => [
                    'type' => 'text',
                ],
                'test2' => [
                    'type' => 'textarea',
                ],
                'test3' => [
                    'type' => 'checkbox',
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertArrayHasKey('test1', $view->children);
        $this->assertEquals(TextType::class, get_class($form->get('test1')->getConfig()->getType()->getInnerType()));

        $this->assertArrayHasKey('test2', $view->children);
        $this->assertEquals(TextareaType::class, get_class($form->get('test2')->getConfig()->getType()->getInnerType()));

        $this->assertArrayHasKey('test3', $view->children);
        $this->assertEquals(CheckboxType::class, get_class($form->get('test3')->getConfig()->getType()->getInnerType()));
    }

    public function testFormWithCustomType()
    {
        $config = [
            'form_fields' => [
                'custom' => [
                    'type' => 'Softspring\Component\DynamicFormType\Test\Form\CustomType',
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertArrayHasKey('custom', $view->children);
        $this->assertEquals(CustomType::class, get_class($form->get('custom')->getConfig()->getType()->getInnerType()));
    }

    public function testCustomDynamicFormWithClassNamespaces()
    {
        $config = [
            'form_fields' => [
                'custom' => [
                    'type' => 'custom',
                ],
            ],
        ];

        $form = $this->factory->create(CustomDynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertArrayHasKey('custom', $view->children);
        $this->assertEquals(CustomType::class, get_class($form->get('custom')->getConfig()->getType()->getInnerType()));
    }

    public function testInvalidType()
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessageMatches("/Type not found for 'invalid' in dynamic form./i");

        $config = [
            'form_fields' => [
                'custom' => [
                    'type' => 'invalid',
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
    }

    public function testInvalidContraints()
    {
        $config = [
            'form_fields' => [
                'custom' => [
                    'type' => 'invalid',
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);


    }
}
