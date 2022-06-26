<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return redirect()->to(\route('index'));
});

Route::group(['middleware' => ['auth']], function(){
   Route::get('/', \App\Http\Livewire\Home::class)->name('index');
   Route::get('users',\App\Http\Livewire\User\Index::class)->name('user.index');
   Route::get('authorization',App\Http\Livewire\User\Authorization\Index::class)->name('authorization.index');
   Route::get('roles',\App\Http\Livewire\User\Roles\Index::class)->name('roles.index');
   Route::get('assigned/roles/{role}',\App\Http\Livewire\User\Roles\AssignedRoles::class)->name('assigned.roles');
   Route::get('user/{user?}', \App\Http\Livewire\User\Form::class)->name('user');
   Route::get('profile',\App\Http\Livewire\User\Profile::class)->name('profile');

   Route::get('report',\App\Http\Livewire\Report::class)->name('report');
});

Auth::routes([
    'register' => false,
    'password.reset' => false,
]);

