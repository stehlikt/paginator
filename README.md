# Paginator

Znovupoužitelná backendová komponenta pro stránkování dat v čistém PHP (bez frameworku) doplněná o webové demo nad mockovými daty 50 uživatelů.

## Požadavky

- PHP 8.2+
- Composer

## Spuštění

```bash
composer install
php -S localhost:8000 -t public
```

Poté otevřete v prohlížeči `http://localhost:8000`.

## Testy

```bash
vendor\bin\phpunit
```

Testy pokrývají paginační logiku v `src/Paginator/Paginator.php` (`tests/Paginator/PaginatorTest.php`).

