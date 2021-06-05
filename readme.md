# Handle async requests

- https://amp.reddit.com/r/PHP/comments/bmrfiq/reactphp_vs_swoole_vs_ratchet_vs_amp_which_do_you/
- https://www.zend.com/blog/why-you-should-use-asynchronous-php

## Swoole

### Plain PHP

- https://www.swoole.co.uk/docs/get-started/installation
- https://www.swoole.co.uk/

### Laravel

1. Make a API route. In `routes/api.php`
```php
Route::get('/test', function() {
    return \App\Models\User::all();
});
```

API can be accessed by `GET localhost/project/public/api/test`

According to POSTMAN, it takes an average of 240ms

2. Install Swoole

Run `pecl install swoole`

Use `php -i | grep php.ini` to find the correct `php.ini`

Add `extension=swoole.so` into `php.ini`

Run `composer require swooletw/laravel-swoole`

Add `SwooleTW\Http\LaravelServiceProvider::class` to the `providers` array of `config/app.php`

Run `php artisan vendor:publish --tag=laravel-swoole`

Run `php artisan swoole:http start`

Now API can be accessed by `GET 127.0.0.1:1215/api/test`

According to POSTMAN, it takes an average of 30ms

#### Tutorials

- https://www.youtube.com/watch?v=dx9k-ciI8ho
- https://www.swoole.co.uk/article/laravel
- https://laravel-news.com/laravel-swoole <sup>good</sup>
- https://www.zend.com/blog/swoole
- https://github.com/swoole/swoole-src
- https://www.medianova.com/en-blog/2020/03/18/swoole-installation-and-laravel
- https://stackoverflow.com/questions/51120098/how-to-install-swoole-in-mac-os

## ReactPHP

---

# Make asynchronous work

## Process 

### Plain PHP

https://github.com/Ruslan-Aliyev/async_php/tree/master/processes

### Spatie

https://github.com/Ruslan-Aliyev/async_php/tree/master/spatie_async

## Threads

https://stackoverflow.com/questions/70855/how-can-one-use-multi-threading-in-php-applications

## Queue 

https://stackoverflow.com/questions/14236296/asynchronous-function-call-in-php

### Plain PHP

- https://devcenter.heroku.com/articles/php-workers

### Laravel

- https://www.youtube.com/watch?v=fFy-s7_SbYM

Use emailing functionality for example.

1. Get mail server credentials/configs sorted
2. In `routes/web.php`
```php
Route::get('sendEmail', function () {
    Mail::send(new SendEmailMailable());
});
```
3. `php artisan make:mail SendEmailMailable`. `app/Mail/SendEmailMailable.php` is created. We should make a view to send for its build function. But for this example, just use the `welcome.blade.php`. 
4. http://localhost/async_php/laravel/public/sendEmail , **But it's slow and it blocks**.

5. Start using queues: https://laravel.com/docs/8.x/queues#driver-prerequisites

6. Configure DB creds in `.env`

7. Run
```
php artisan queue:table
php artisan migrate
```

8. `php artisan make:job SendMailJob`

9. Move this line `Mail::to('ruslandeveloper2020@gmail.com')->send(new SendEmailMailable());` from `routes/web.php` to `App\Jobs\SendMailJob::handle`

10. Dispatch the job from `routes/web.php`

11. In `.env`: `QUEUE_CONNECTION=database` instead of `sync`. (This affects `config/queue.php`)

12. Now if you go to http://localhost/async_php/laravel/public/sendEmail , the reaction is instant. But email isn't sent. Instead it's queued up in the DB `jobs` table. 

13. Now we just need another process to 'flush' those jobs. https://laravel.com/docs/8.x/queues#running-the-queue-worker

14. Run `php artisan queue:work` in another terminal.

---

# Make async http requests

## Async Guzzle

Theory: https://stackoverflow.com/questions/35655616/how-does-guzzle-send-async-web-requests

- CURL in plain PHP: https://github.com/Ruslan-Aliyev/async_php/tree/master/curl
- Normal Guzzle and **async Guzzle**: https://github.com/Ruslan-Aliyev/async_php/tree/master/guzzle

## Socket and log file

- https://segment.com/blog/how-to-make-async-requests-in-php/
	- https://stackoverflow.com/questions/124462/how-to-make-asynchronous-http-requests-in-php/2924987#2924987
