<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LeadTrivia;

Route::get('/', LeadTrivia::class)->name('lead.trivia');