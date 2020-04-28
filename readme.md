# Laravel Activity Logger

baru bikin . nanti dulu

jalankan perintah
```php
composer require rudestewing/laravel-activity-logger
```

buka file di config/app.php
tambahkan service provider pada key 'providers'

```php

    'providers' => [
        ...

        Rudestewing\ActivityLogger\ActivityLogServiceProvider::class,

        ...
    ];

```

jalankan perintah
```php
php artisan vendor:publish --provider="Rudestewing\ActivityLogger\ActivityLogServiceProvider" --tag="migrations" 
```
kemudian lakukan migration
```php
php artisan migrate
```


### How to Use

tambahkan ActivityLogger Trait pada model yang ingin di log

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rudestewing\ActivityLogger\Traits\ActivityLogger;

class Post extends Model
{
    protected $guarded = [];
    
    use ActivityLogger;
}

```