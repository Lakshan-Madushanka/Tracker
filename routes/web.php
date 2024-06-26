<?php

declare(strict_types=1);

use App\Livewire\Categories\CategoryList;
use App\Livewire\Errors\ErrorList;
use App\Livewire\Links\LinkList;
use Illuminate\Support\Facades\Route;

Route::get('/', ErrorList::class)->name('home');
Route::get('categories', CategoryList::class)->name('categories');
Route::get('links', LinkList::class)->name('links');
