# A Nova field to replace BelongsTo field for on the go resource creation.

Form Field 
![Screenshot Field](https://github.com/shivanshrajpoot/nova-create-or-add/raw/master/nova-create-or-add-form.png)
Form Expanded
![Screenshot Form Open](https://github.com/shivanshrajpoot/nova-create-or-add/raw/master/nova-create-or-add-form-open.png)

## Note
This package is incompatible with [Prepopulate Searchable](https://github.com/alexbowers/nova-prepopulate-searchable) and the package is broken  The Mainteners are no longer interested so i fixed both and will.

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require mustafatoker/nova-create-or-add
```
## Usage

```php
// in Resource File
use MustafaTOKER\NovaCreateOrAdd\NovaCreateOrAdd;

// ...

NovaCreateOrAdd::make('Manufacturer')
  ->searchable()
  ->prepopulate()
  ->rules('required'),
```

## Credits

- [Alex Bowers](https://github.com/alexbowers)
- [Mustafa TOKER](https://github.com/mustafatoker)
- [Burak Tekin](https://github.com/tekinburak)
- Mustafa Demir

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
