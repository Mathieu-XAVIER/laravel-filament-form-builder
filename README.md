# Laravel Nova Form Builder

Form builder for Laravel Nova. 

Drag and drop interface to manage fields. 

This package uses [laravel-form](http://gitlab.novius.net/lara_libs/laravel-form) and it simply provides a visual interface based on Laravel Nova.

![Demo image](http://gitlab.novius.net/lara_libs/laravel-nova-form-builder/wikis/uploads/380784f509d3576d36f20ce41c174303/form-builder-demo.gif)

## Requirements

* PHP >= 8.2
* Laravel Framework >= 10.0
* Laravel Nova >= 5.0

> **NOTE**: These instructions are for Laravel >= 10.x and PHP >= 8.2. If you are using prior version, please
> see the [previous version's docs](/lara_libs/laravel-nova-form-builder/-/tree/2.x).
> 
## Installation

```sh
composer require novius/laravel-nova-form-builder
```

Add `LaravelFormBuilder` tool to `NovaServiceProvider`: 

```php
namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Novius\LaravelFormBuilder\LaravelFormBuilder;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    // ...
    
    public function tools()
    {
        return [
            new LaravelFormBuilder(),
        ];
    }
}

```


Next, publish public files : 

```sh
php artisan vendor:publish --provider="Novius\LaravelFormBuilder\LaravelFormBuilderServiceProvider" --tag="public"
```

Then, please follow instructions of [laravel-form package](http://gitlab.novius.net/lara_libs/laravel-form).

## Configuration

Some options that you can override are available.

```sh
php artisan vendor:publish --provider="Novius\LaravelFormBuilder\LaravelFormBuilderServiceProvider" --tag="config"
```

## Lint

Run php-cs with:

```sh
composer run-script lint
```

## Contributing

Contributions are welcome!

Leave an issue on Github, or create a Pull Request.

## Credits

This package is based on [qiaoxun/vue-formbuilder](https://github.com/qiaoxun/vue-formbuilder).

## Licence

This package is under [GNU Affero General Public License v3](http://www.gnu.org/licenses/agpl-3.0.html) or (at your option) any later version.
