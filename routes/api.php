<?php

use Illuminate\Support\Facades\Route;

Route::get('/{resource}/required-creation-fields', '\MustafaTOKER\NovaCreateOrAdd\Http\Controllers\CreationFieldController@index');
