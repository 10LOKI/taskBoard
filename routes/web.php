<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', function ()
{
    return view('contact');
});
Route::post('/contact',function (Request $request)
{
$validated = $request -> validate([
    'name' => 'required',
    'email' => 'required|email',
    'message' => 'required|min:8|max:1000'
]);
return redirect('/');
});
