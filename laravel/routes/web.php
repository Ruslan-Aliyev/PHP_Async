<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\SendMailJob;
use App\Jobs\AnotherJob;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('sendEmail', function () {
    //dispatch(new SendMailJob);
    
    $job = (new SendMailJob)
        ->delay(now()->addSeconds(5));
    dispatch($job);

    // another queue
    $anotherJob = (new AnotherJob)
        ->onQueue('another')
        ->delay(now()->addSeconds(5));
    dispatch($anotherJob);

    return 'Email sent';
});
