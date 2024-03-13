<?php

declare(strict_types=1);

use App\Livewire\Errors\ErrorList;
use Illuminate\Support\Facades\Route;

Route::get('/', ErrorList::class)->name('home');
