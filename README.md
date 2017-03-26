# CNP Validator
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/1bd345b5a40144d48647bb79b0b8f91d)](https://www.codacy.com/app/laravel-enso/CnpValidator?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/CnpValidator&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85675542/shield?branch=master)](https://styleci.io/repos/85675542)
[![Total Downloads](https://poser.pugx.org/laravel-enso/cnpvalidator/downloads)](https://packagist.org/packages/laravel-enso/cnpvalidator)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/cnpvalidator/version)](https://packagist.org/packages/laravel-enso/cnpvalidator)

Romanian CNP validator for Laravel

### Instalation

1. Add `'LaravelEnso\CnpValidator\CnpValidatorServiceProvider::class'` to your providers list in config/app.php or you could add directly to your AppServiceProvider like this:

```
	public function boot()
    {
        Validator::extend('cnp', 'LaravelEnso\CnpValidator\App\Classes\Validations@validatorCnp');
    }
```

2. Use the cnp validator in your form request

```
public function rules()
{
    return [
        'cnp' => 'required|unique:users|cnp',
    ];
}
```

### Note

If your application has multiple languages don't forget to add the translations in resources/lang/**/validation.php unde the `cnp` key.

### Contributions

are welcome