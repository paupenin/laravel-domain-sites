# Laravel Domain Sites
Laravel Package for dynamic domain based sites

## Installation
### Version Control
#### composer.json
```json
{
    "name": "laravel/laravel",
    "repositories": [
      {
        "type": "vcs",
        "url": "https://github.com/paupenin/laravel-domain-sites"
      }
    ],
    "require": {
        "modules/sites": "*"
    }
}
```

Don't forget to run:
```
  composer update
```

## Usage

### Package Service Provider
#### config/app.php
```php
  'providers' => [
      Paupenin\DomainSites\Providers\DomainSitesServiceProvider::class,
  ]
  'aliases' => [
      'Domain' => Paupenin\DomainSites\Domain::class,
      'Site' => Paupenin\DomainSites::class,
  ]
```

### Database
```
  artisan migrate
```
