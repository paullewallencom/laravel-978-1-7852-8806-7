<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {

    $table = DB::table('users');
    $data = $table->get();

    return $data;
});

Route::get('/sync/{from}/{to}/{table}', function ($from, $to, $table) {

    $fromDB = DB::connection($from);
    $toDB = DB::connection($to);

    $data = $fromDB->table($table)->get();
    $data = json_decode(json_encode($data), true);

    $toDB->table($table)->truncate();
    $toDB->table($table)->insert($data);

    return 'success';
});
