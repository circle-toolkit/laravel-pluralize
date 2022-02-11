# Laravel Pluralize

Clean way to write pluralize translations.

## Usage

In any of your translation file you can use the helper method `trans_pluralize`.

```php
return [
    'apples' => trans_pluralize('There is one apple')->as('There are many apples'),
    
    'oranges' => trans_pluralize()
                    ->case([0], 'There are none')
                    ->range([1, 19], 'There are some')
                    ->range([20, '*'], 'There are many')
                    ->build(),
                    
    'time' => trans_pluralize()
                    ->case([0], ':value minute ago')
                    ->range([20, '*'], ':value minutes ago')
                    ->build()
];

```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
