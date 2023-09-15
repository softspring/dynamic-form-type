# CHANGELOG

## [v5.1.0](https://github.com/softspring/dynamic-form-type/releases/tag/v5.1.0)

### Upgrading

*Nothing to do on upgrading*

### Commits

- [35cc998](https://github.com/softspring/dynamic-form-type/commit/35cc9983da0b3c6171ff875ef2b59e7d642ce536): Improve module test case
- [c32e8c8](https://github.com/softspring/dynamic-form-type/commit/c32e8c81eb75a04551f22b69cf9bbf03945a72da): Bump timkrase/phpunit-coverage-badge from 1.2.0 to 1.2.1
- [caae1e9](https://github.com/softspring/dynamic-form-type/commit/caae1e9ea31b3fbfc91bd02f38482553a39a6eba): Fix phpstan
- [bf56fc4](https://github.com/softspring/dynamic-form-type/commit/bf56fc43405935e98174d06cc4621195cf7d2a98): Remove DynamicTypeInterface, only use extension
- [a02f67c](https://github.com/softspring/dynamic-form-type/commit/a02f67c6dcea6328cbca40ca5173859810be1d1d): Refactor dynamic form type to form extensions
- [989f0d5](https://github.com/softspring/dynamic-form-type/commit/989f0d54c10493478ab2705e3467ef6f8f657814): Refactor dynamic form type to form extensions
- [d101f9f](https://github.com/softspring/dynamic-form-type/commit/d101f9f3519a42f89f07cf8b279cb1dc5c6ea867): Update dependabot
- [2cf7db3](https://github.com/softspring/dynamic-form-type/commit/2cf7db3c53b25e604d8131a11dba3fd463dffa4a): Configure dependabot and phpmd
- [d53b58e](https://github.com/softspring/dynamic-form-type/commit/d53b58e257fe954012649d52b92b8eb80c73aa2b): Update changelog for v5.0.6
- [fa78eee](https://github.com/softspring/dynamic-form-type/commit/fa78eeef96a893d18ba5f867c9ff19af937fb6c0): Configure new 5.1 development version
- [25e9a6c](https://github.com/softspring/dynamic-form-type/commit/25e9a6c9261111a1acfe3a862f4b89f576e1328d): Add 5.1 branch alias to composer.json

### Changes

```
 .github/dependabot.yml                             | 12 +++++
 .github/workflows/php.yml                          |  6 +--
 .github/workflows/phpmd.yml                        | 57 +++++++++++++++++++++
 CHANGELOG.md                                       |  4 --
 README.md                                          |  4 +-
 composer.json                                      |  3 +-
 config/dynamic_form_type.yaml                      | 17 +++++++
 phpstan-baseline.neon                              |  8 +++
 src/Form/DynamicFormCollectionType.php             |  2 +-
 src/Form/DynamicFormTrait.php                      | 52 ++++---------------
 src/Form/DynamicFormType.php                       | 14 ------
 src/Form/Extension/DynamicFormExtension.php        | 27 ++++++++++
 .../Extension/Type/DynamicConstraintsExtension.php | 58 ++++++++++++++++++++++
 src/Form/Extension/Type/DynamicTypesExtension.php  | 38 ++++++++++++++
 src/Form/Resolver/ConstraintResolver.php           | 33 ++++++++++++
 src/Form/Resolver/ConstraintResolverInterface.php  |  8 +++
 src/Form/Resolver/TypeResolver.php                 | 33 ++++++++++++
 src/Form/Resolver/TypeResolverInterface.php        |  8 +++
 tests/Form/DynamicFormCollectionTypeTest.php       | 15 ++++++
 tests/Form/DynamicFormTypeTest.php                 | 40 ++++++++++-----
 20 files changed, 360 insertions(+), 79 deletions(-)
```

## [v5.0.5](https://github.com/softspring/dynamic-form-type/releases/tag/v5.0.5)

### Upgrading

*Nothing to do on upgrading*

### Commits

- [163a81c](https://github.com/softspring/dynamic-form-type/commit/163a81c94e0bfc299648daaf4040adfae9844610): Update changelog

### Changes

```
 CHANGELOG.md | 21 +++++++++++++++++++++
 1 file changed, 21 insertions(+)
```

## [v5.0.4](https://github.com/softspring/dynamic-form-type/releases/tag/v5.0.4)

*Nothing has changed since last v5.0.3 version*

## [v5.0.3](https://github.com/softspring/dynamic-form-type/releases/tag/v5.0.3)

*Nothing has changed since last v5.0.2 version*

## [v5.0.2](https://github.com/softspring/dynamic-form-type/releases/tag/v5.0.2)

*Nothing has changed since last v5.0.1 version*

## [v5.0.1](https://github.com/softspring/dynamic-form-type/releases/tag/v5.0.1)

*Nothing has changed since last v5.0.0 version*

## [v5.0.0](https://github.com/softspring/dynamic-form-type/releases/tag/v5.0.0)

*Previous versions are not in changelog*
