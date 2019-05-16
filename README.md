<!--h-->
# CNP Validator

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/1bd345b5a40144d48647bb79b0b8f91d)](https://www.codacy.com/app/laravel-enso/cnp-validator?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/cnp-validator&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85675542/shield?branch=master)](https://styleci.io/repos/85675542)
[![License](https://poser.pugx.org/laravel-enso/actionlogger/license)](https://packagist.org/packages/laravel-enso/actionlogger)
[![Total Downloads](https://poser.pugx.org/laravel-enso/cnp-validator/downloads)](https://packagist.org/packages/laravel-enso/cnp-validator)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/cnp-validator/version)](https://packagist.org/packages/laravel-enso/cnp-validator)
<!--/h-->

Romanian CNP validator for Laravel

### Instalation Steps

1. Add `'LaravelEnso\CnpValidator\CnpValidatorServiceProvider::class'` to your providers list in config/app.php.

2. Use the CNP validator in your ValidateModelRequest validation class

    ```
    public function rules()
    {
        return [
            'cnp' => [
                    'max:13',
                    'cnp',
                    'nullable',
                    request()->getMethod() == 'PATCH'
                        ? Rule::unique('users', 'nin')->ignore(route('user')->id)
                        : Rule::unique('users', 'nin')
                ],
        ];
    }
    ```

### Notes

Don't forget to add the translation for the validator error message in `resources/lang/**/validation.php` under the `cnp` key.

The [Laravel Enso Core](https://github.com/laravel-enso/Core) package comes with this package included.

<!--h-->
### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
<!--/h-->