[![Latest Stable Version](http://poser.pugx.org/thomasdeluck/code-generator/v)](https://packagist.org/packages/thomasdeluck/code-generator)
[![Total Downloads](http://poser.pugx.org/thomasdeluck/code-generator/downloads)](https://packagist.org/packages/thomasdeluck/code-generator)
[![Latest Unstable Version](http://poser.pugx.org/thomasdeluck/code-generator/v/unstable)](https://packagist.org/packages/thomasdeluck/code-generator)
[![License](http://poser.pugx.org/thomasdeluck/code-generator/license)](https://packagist.org/packages/thomasdeluck/code-generator)
[![PHP Version Require](http://poser.pugx.org/thomasdeluck/code-generator/require/php)](https://packagist.org/packages/thomasdeluck/code-generator)

# Code Generator for Laravel
Using this package to generate controller, migration, model, route, request, resource for your Laravel application

## Installation
```composer require thomasdeluck/code-generator --dev```

## Usage
* Run `php artisan generate:all {YOUR_MODEL_NAME} --field={FIELD_NAME}:{FIELD_TYPE}`
* Example: `php artisan generate:all product --field=name:string`
* Available field types: **smallint**, **bigint**, **datetimetz**, **blob**, **integer**, **boolean**, **date**, **time**, **datetime**, **text**, **decimal**, **float**, **object**, **array**, **simple_array**, **json_array**, **guid**
* You can custom your own templates by running `php artisan vendor:publish --tag=code-generator`
* You can also use our `BaseService` by extending `ThomasDeLuck\CodeGenerator\Services\BaseService` class or create your own
* List of variables used in filename: 
**(XXX)** is equivalent to **.XXX** (extension), 
**{YYY}** is equivalent to global config variable **YYY** (defined in `config/generator`)
**[ZZZ]** is equivalent to model form variable **ZZZ** (available values: **PLURAL_UPPER**, **PLURAL_LOWER**, **PLURAL_UC**, **PLURAL_STUDLY**, **PLURAL_CAMEL**, **PLURAL_KEBAB**, **PLURAL_SNAKE**, **UPPER**, **LOWER**, **UC**, **STUDLY**, **CAMEL**, **KEBAB**, **SNAKE**)
* You can also use model form variables and global config variables in templates