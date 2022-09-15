# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.2.36] - 2022-09-16

### Added
- Table of contents in Markdown generator.

## [0.2.35] - 2022-01-02

### Fixes
- Support for PHP 8.1.

## [0.2.34] - 2021-07-22

### Fixes
- Handling of conflicting constant names for `enum` in generated classes.

## [0.2.33] - 2021-05-27

### Fixes
- Handling of `const` constraints in generated classes.

## [0.2.32] - 2021-04-25

### Added
- Support for Markdown rendering of JSON Schema.
- Support for binary strings (files) in JSDoc.

## [0.2.31] - 2021-04-12

### Added
- Support for optional values in JSDoc.

### Fixed
- Map types in JSDoc.

## [0.2.30] - 2021-04-08

### Added
- Support for const/enum in JSDoc.
- Control to prefix JSDoc types.

## [0.2.29] - 2021-04-07

### Added
- JSDoc type builder from JSON Schema.

## [0.2.28] - 2020-09-22

### Added
- Dependencies updated.

### Fixed
- Missing `default` in generated schema with `swaggest/json-schema` `v0.12.31`.

## [0.2.27] - 2020-08-31

### Fixed
- Duplicated symbol declaration, [#33](https://github.com/swaggest/php-code-builder/pull/33).

## [0.2.26] - 2020-06-16

### Fixed
- `PhpClass` setExtends if getExtends is null in `PhpBuilder`.

## [0.2.25] - 2020-01-10

### Added
- `PhpBuilder` flag `buildAdditionalPropertyMethodsOnTrue` to create accessors for untyped additional properties.

## [0.2.24] - 2020-01-07

### Added
- Option to declare default property values in PHP classes generated from JSON schema, [#29](https://github.com/swaggest/php-code-builder/pull/29).

## [0.2.23] - 2019-12-11

### Added
- Support to use traits in `PhpClass`.

## [0.2.22] - 2019-12-02

### Fixed
- Pattern property setter regexp check.

## [0.2.21] - 2019-10-25

### Changed
- Magical `phpdoc` for nullable properties instead of explicit properties.
- Better property names collision resolution.

## [0.2.20] - 2019-10-02

### Fixed
- Missing return and argument phpdoc types for `array` and `mixed`.

## [0.2.19] - 2019-10-02

### Added
- Schema exporter split into protected methods to allow extension.

## [0.2.18] - 2019-09-22

### Fixed
- Description trimming bug.

[0.2.36]: https://github.com/swaggest/php-code-builder/compare/v0.2.35...v0.2.36
[0.2.35]: https://github.com/swaggest/php-code-builder/compare/v0.2.34...v0.2.35
[0.2.34]: https://github.com/swaggest/php-code-builder/compare/v0.2.33...v0.2.34
[0.2.33]: https://github.com/swaggest/php-code-builder/compare/v0.2.32...v0.2.33
[0.2.32]: https://github.com/swaggest/php-code-builder/compare/v0.2.31...v0.2.32
[0.2.31]: https://github.com/swaggest/php-code-builder/compare/v0.2.30...v0.2.31
[0.2.30]: https://github.com/swaggest/php-code-builder/compare/v0.2.29...v0.2.30
[0.2.29]: https://github.com/swaggest/php-code-builder/compare/v0.2.28...v0.2.29
[0.2.28]: https://github.com/swaggest/php-code-builder/compare/v0.2.27...v0.2.28
[0.2.27]: https://github.com/swaggest/php-code-builder/compare/v0.2.26...v0.2.27
[0.2.26]: https://github.com/swaggest/php-code-builder/compare/v0.2.25...v0.2.26
[0.2.25]: https://github.com/swaggest/php-code-builder/compare/v0.2.24...v0.2.25
[0.2.24]: https://github.com/swaggest/php-code-builder/compare/v0.2.23...v0.2.24
[0.2.23]: https://github.com/swaggest/php-code-builder/compare/v0.2.22...v0.2.23
[0.2.22]: https://github.com/swaggest/php-code-builder/compare/v0.2.21...v0.2.22
[0.2.21]: https://github.com/swaggest/php-code-builder/compare/v0.2.20...v0.2.21
[0.2.20]: https://github.com/swaggest/php-code-builder/compare/v0.2.19...v0.2.20
[0.2.19]: https://github.com/swaggest/php-code-builder/compare/v0.2.18...v0.2.19
[0.2.18]: https://github.com/swaggest/php-code-builder/compare/v0.2.17...v0.2.18
