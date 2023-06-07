<?php

namespace Softspring\Component\DynamicFormType\Test\Form;

use Softspring\Component\DynamicFormType\Form\DynamicFormType;
use Softspring\Component\DynamicFormType\Form\Extension\DynamicFormExtension;
use Softspring\Component\DynamicFormType\Form\Resolver\ConstraintResolver;
use Softspring\Component\DynamicFormType\Form\Resolver\TypeResolver;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\Traits\ValidatorExtensionTrait;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Validator\Constraints;

class DynamicFormTypeTest extends TypeTestCase
{
    use ValidatorExtensionTrait;

    protected function getExtensions(): array
    {
        $extensions = parent::getExtensions();

        $extensions[] = new DynamicFormExtension(new TypeResolver(), new ConstraintResolver());

        return $extensions;
    }

    public function testEmptyForm(): void
    {
        $config = [];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $view = $form->createView();

        $this->assertCount(0, $view->children);
    }

    public function testFormWithFieldWithNoConfig(): void
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

    public function testFormWithTextField(): void
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

    public function testFormWithTextFieldAndSomeOptions(): void
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

    public function testFormWithMultipleFields(): void
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

    public function testFormWithCustomType(): void
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

    public function testCustomDynamicFormWithClassNamespaces(): void
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

    public function testInvalidType(): void
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

    public function testInvalidConstraint(): void
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('Invalid constraint configuration, you must specify a constraint type');

        $config = [
            'form_fields' => [
                'test1' => [
                    'type' => 'text',
                    'type_options' => [
                        'constraints' => [
                            [],
                        ],
                    ],
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
    }

    public function testInvalidConstraintType(): void
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessageMatches("/Constraint 'invalid' not found in dynamic form./i");

        $config = [
            'form_fields' => [
                'test1' => [
                    'type' => 'text',
                    'type_options' => [
                        'constraints' => [
                            ['constraint' => 'invalid'],
                        ],
                    ],
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
    }

    public function testConstraints(): void
    {
        $config = [
            'form_fields' => [
                'test1' => [
                    'type' => 'text',
                    'type_options' => [
                        'constraints' => [
                            ['constraint' => 'notBlank'],
                            ['constraint' => 'range', 'options' => ['min' => 1, 'max' => 100]],
                            ['constraint' => CustomConstraint::class],
                        ],
                    ],
                ],
            ],
        ];

        $form = $this->factory->create(DynamicFormType::class, [], $config);
        $processedConstraints = $form->get('test1')->getConfig()->getOptions()['constraints'];

        // assert first constraint
        $this->assertInstanceOf(Constraints\NotBlank::class, $processedConstraints[0]);

        // assert second constraint
        $this->assertInstanceOf(Constraints\Range::class, $processedConstraints[1]);
        $this->assertEquals(1, $processedConstraints[1]->min);
        $this->assertEquals(100, $processedConstraints[1]->max);

        // assert third constraint
        $this->assertInstanceOf(CustomConstraint::class, $processedConstraints[2]);
    }
}
