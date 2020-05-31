# adonis-model-utilities
A set of tools to use within your Laravel Models

## 1. Install

Install package

```bash
$ composer require igortrinidad/laravel-model-utilities
```

## 2. Use the traits you need inside your models:

Add traits you need to the model and set the fields that you want to format, see the full example:
```php

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use IgorTrinidad\ModelUtilities\Traits\Uuid;
use IgorTrinidad\ModelUtilities\Traits\TitleCase;
use IgorTrinidad\ModelUtilities\Traits\SanitizeEmail;
use IgorTrinidad\ModelUtilities\Traits\FormatDate;
use IgorTrinidad\ModelUtilities\Traits\FormatCurrency;

class User extends Authenticatable
{
    use Notifiable, Uuid, TitleCase, SanitizeEmail, FormatDate, FormatCurrency;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bday',
        'value'
    ];

    /**
     * The columns that should be applied Title Case
     * This trait will format the columns that should be Title Case before saving in db
     *
     * @var array
     */
    protected $titleCases = [
        'name',
    ];

    /**
     * The columns to apply email sanitization
     *
     * @var array
     */
    protected $emailColumns = [
        'email'
    ];

    /**
     * The date columns that you want to format for the end user
     * The unformatted is the same of your database date format
     * The formatted is the way you want to show for your end user
     * This will format the date column just after retrieved of the db and unformat before saving in db
     *
     * @var array
     */
    protected $dateColumns = [
        'bday' => [
            'unformatted' => 'Y-m-d',
            'formatted' => 'd/m/Y'
        ]
    ];

    /**
     * The currency columns you want to format
     * This will create a model attribute like 'formatted_value'
     * 'value' is the name of the column in your dabase
     *
     * @var array
     */
    protected $currencyColumns = [
        'value' => [
            'prefix' => 'US$ ',
            'decimal' => ',',
            'thousand' => '.',
            'precision' => 2
        ]
    ];

    //...
}

```

### Format Currency Settings:

The key of the array $currencyColumns should be the same name of the column that will be formatted
```php
<?php

use IgorTrinidad\ModelUtilities\Traits\FormatCurrency;

class Product extends Model {

    use FormatCurrency;

    /**
     * The currency columns you want to format
     * This will create a model attribute like 'formatted_value'
     * 'value' is the name of the column in your dabase
     *
     * @var array
     */
    protected $currencyColumns = [
        'value' => [
            'prefix' => 'US$ ',
            'decimal' => ',',
            'thousand' => '.',
            'precision' => 2
        ],
        'discount' => [
            'prefix' => 'US$ ',
            'decimal' => ',',
            'thousand' => '.',
            'precision' => 2
        ]
    ];

}
```
##### This trait doesn't change the value of the model on saving or updating, just create the attributes 'formatted_value' and 'formatted_discount' for the model after ::retrieved the model from the database


### Format Date Trait:

Add trait to the model and set the fields that should be formatted:
```php
<?php

use IgorTrinidad\ModelUtilities\Traits\FormatDate;

class User extends Model {

    use FormatDate;

    /**
     * The currency columns you want to format
     * This will create a model attribute like 'formatted_value'
     * 'value' is the name of the column in your dabase
     *
     * @var array
     */
    protected $dateColumns = [
        'bday' => [
            'unformatted' => 'Y-m-d', //Default unformat date format
            'formatted' => 'd/m/Y' // Default formatted date format
        ]
    ];

}
```


### Uuid:

Add uuid to the ID column for the model, setting the incrementing to false

```php
<?php

use IgorTrinidad\ModelUtilities\Traits\Uuid;

class User extends Model {
    
    //Just add the trait inside your model
    use Uuid;

    //The rest of your model

}
```

This trait use [Ramsey Uuid::uuid4](https://github.com/ramsey/uuid) the same as [Laravel Str::uuid](https://laravel.com/docs/7.x/helpers#method-str-uuid) to generate the uuid

#### Example of migration using Uuid in Laravel
```php
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

```

## Stand-alone use

If you wish you could use the functions of ModelUtilities stand-alone too

#### Example of stand alone use for formatCurrency method
```php
use IgorTrinidad\ModelUtilities\ModelUtilities;

$value = 1234.32;

$currency = ModelUtilities::formatCurrency($value, 'R$ ', 2, ',', '.');


```

This output the formatted value: 'R$ 1.234,32';

### Stand-alone methods availables

```php

ModelUtilities::formatCurrency($value, 'R$ ', 2, ',', '.');

ModelUtilities::formatDate($date, 'Y-m-d', 'd/m/Y');

ModelUtilities::titleCase($string);

ModelUtilities::sanitizeEmail($email);

```

## Author


* **Igor Trindade** - *Developer*
* [github.com/igortrinidad](https://github.com/igortrinidad)
* [https://igortrindade.dev](https://igortrindade.dev)


## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.


## Changelog

- v1.0.2
  - Initial release.
  