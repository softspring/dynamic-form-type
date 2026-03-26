# Dynamic Form Type Features

Functional definition for `softspring/dynamic-form-type`.

This file defines the expected behavior and scope of the component.

## Purpose

- Build Symfony forms from array-based field definitions.
- Allow applications to create forms dynamically when the structure is not fixed in a dedicated PHP form type.

## Main Features

- Provide a `DynamicFormType` that adds fields from a `form_fields` array option.
- Provide a `DynamicFormCollectionType` for collections of dynamic form entries.
- Resolve field types from short aliases such as `text`, from fully qualified form type classes, and from custom resolvers.
- Resolve validator constraints from short aliases or fully qualified constraint classes.
- Keep the type-resolution layer extensible through chained resolvers.

## Expected Usage

- Use it when form definitions come from configuration, database-backed definitions, or runtime business rules.
- Pass field definitions through the `form_fields` option.
- Use `type_options` to configure the Symfony options of each generated field.
- Use custom type resolvers when applications need extra namespaces or custom alias logic.

## Operational Expectations

- Empty dynamic forms should be allowed.
- Unknown types should fail with a clear form configuration error.
- Invalid constraint definitions should fail with a clear options or configuration error.
- Generated fields should behave like normal Symfony form fields once resolved.

## Current Limits

- The component focuses on field generation, not on dynamic templates or UI builders.
- It expects the caller to provide valid array configuration.
- The default resolver only knows a small set of namespaces and naming conventions.
