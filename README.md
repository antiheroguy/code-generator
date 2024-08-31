![Packagist Version](https://img.shields.io/packagist/v/antiheroguy/code-generator)

# Code Generator for Laravel
Using this package to generate controller, migration, model, route, request, resource for your Laravel application

## Installation
```shell
composer require antiheroguy/code-generator --dev
```

## Usage
```shell
php artisan generate:code YOUR_MODEL_NAME --field "FIELD_NAME:FIELD_TYPE"
```

### Example
```shell
php artisan generate:code product --field "name:string"
```

### Custom your own templates 
```shell
php artisan vendor:publish --tag=code-generator
```

* Available field types: **smallint**, **bigint**, **datetimetz**, **blob**, **integer**, **boolean**, **date**, **time**, **datetime**, **text**, **decimal**, **float**, **object**, **array**, **simple_array**, **json_array**, **guid**
* You can also use our `BaseService` by extending `AntiHeroGuy\CodeGenerator\Services\BaseService` class or create your own
* List of variables used in filename: 
  **(XXX)** is equivalent to **.XXX** (extension)
  **{YYY}** is equivalent to global config variable **YYY** (defined in `config/generator`)
  **[ZZZ]** is equivalent to model form variable **ZZZ** (available values: **PLURAL_UPPER**, **PLURAL_LOWER**, **PLURAL_UC**, **PLURAL_STUDLY**, **PLURAL_CAMEL**, **PLURAL_KEBAB**, **PLURAL_SNAKE**, **UPPER**, **LOWER**, **UC**, **STUDLY**, **CAMEL**, **KEBAB**, **SNAKE**)
* You can also use model form variables and global config variables in templates