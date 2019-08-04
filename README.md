# Swaggest JSON-schema enabled PHP code builder

[![Build Status](https://travis-ci.org/swaggest/php-code-builder.svg?branch=master)](https://travis-ci.org/swaggest/php-code-builder)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/swaggest/php-code-builder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/swaggest/php-code-builder/?branch=master)
[![Code Climate](https://codeclimate.com/github/swaggest/php-code-builder/badges/gpa.svg)](https://codeclimate.com/github/swaggest/php-code-builder)
[![codecov](https://codecov.io/gh/swaggest/php-code-builder/branch/master/graph/badge.svg)](https://codecov.io/gh/swaggest/php-code-builder)

This library generates PHP mapping structures defined by [JSON schema](http://json-schema.org/)
using [`swaggest/json-schema`](https://github.com/swaggest/php-json-schema).

## Example

[Generated code](tests/src/Tmp/Example)

You need to add `swaggest/json-schema` to your dependencies.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$schemaData = json_decode(<<<'JSON'
{
    "type": "object",
    "properties": {
        "id": {"type": "integer"},
        "name": {"type": "string"},
        "parent": {"$ref": "#"},
        "children": {"type": "array", "items": {"$ref": "#"}},
        "info": {"$ref": "#/definitions/info"}
    },
    "definitions": {
        "info": {
            "type": "object",
            "properties": {
                "lastName": {"type": "string"},
                "birthDate": {"type": "string", "format": "date-time"},
                "options": {"$ref": "#/definitions/options"}
            }
        },
        "options": {
            "type": "object",
            "properties": {
                "rememberSession": {"type": "boolean"},
                "allowNotifications": {"type": "boolean"}
            }
        }
    }
}
JSON
);

$swaggerSchema = \Swaggest\JsonSchema\Schema::import($schemaData);

$appPath = realpath(__DIR__ . '/tests/src/Tmp') . '/Example';
$appNs = 'Swaggest\PhpCodeBuilder\Tests\Tmp\Example';

$app = new \Swaggest\PhpCodeBuilder\App\PhpApp();
$app->setNamespaceRoot($appNs, '.');

$builder = new \Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder();
$builder->buildSetters = true;
$builder->makeEnumConstants = true;

$builder->classCreatedHook = new \Swaggest\PhpCodeBuilder\JsonSchema\ClassHookCallback(
    function (\Swaggest\PhpCodeBuilder\PhpClass $class, $path, $schema) use ($app, $appNs) {
        $desc = '';
        if ($schema->title) {
            $desc = $schema->title;
        }
        if ($schema->description) {
            $desc .= "\n" . $schema->description;
        }
        if ($fromRefs = $schema->getFromRefs()) {
            $desc .= "\nBuilt from " . implode("\n" . ' <- ', $fromRefs);
        }

        $class->setDescription(trim($desc));

        $class->setNamespace($appNs);
        if ('#' === $path) {
            $class->setName('User'); // Class name for root schema
        } elseif (strpos($path, '#/definitions/') === 0)) {
            $class->setName(\Swaggest\PhpCodeBuilder\PhpCode::makePhpClassName(
                substr($path, strlen('#/definitions/'))));
        }
        $app->addClass($class);
    }
);

$builder->getType($swaggerSchema);
$app->clearOldFiles($appPath);
$app->store($appPath);
```

Creating and exporting an instance

```php
$user = new \Swaggest\PhpCodeBuilder\Tests\Tmp\Example\User();
$user->name = "John";
$user->info = (new \Swaggest\PhpCodeBuilder\Tests\Tmp\Example\Info())
    ->setLastName("Doe")
    ->setBirthDate("1980-01-01")
    ->setOptions(
        (new \Swaggest\PhpCodeBuilder\Tests\Tmp\Example\Options())
            ->setRememberSession(true)
            ->setAllowNotifications(false)
    );

// No exception on exporting valid data
$jsonData = \Swaggest\PhpCodeBuilder\Tests\Tmp\Example\User::export($user);

// {"name":"John","info":{"lastName":"Doe","birthDate":"1980-01-01","options":{"rememberSession":true,"allowNotifications":false}}}
echo json_encode($jsonData);

// Setting invalid value (integer instead of string)
$user->name = 123;

// Exception: String expected, 123 received at #->$ref[#]->properties:name
$jsonData = \Swaggest\PhpCodeBuilder\Tests\Tmp\Example\User::export($user);
```

Creating class instance from raw data

```php
// Importing raw data to entity class instance will do validation and mapping
$user = \Swaggest\PhpCodeBuilder\Tests\Tmp\Example\User::import(
    json_decode('{"name":"John","info":{"lastName":"Doe","birthDate":"1980-01-01","options":{"rememberSession":true,"allowNotifications":false}}}')
);

var_dump($user->info->options->allowNotifications); // bool(false)
```
