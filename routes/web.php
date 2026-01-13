<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::livewire('/', 'index')->name('home');
Route::livewire('/string', 'example.string')->name('string');
Route::livewire('/layout', 'example.layout')->name('layout');