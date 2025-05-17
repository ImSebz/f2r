<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LeadTrivia;
use App\Livewire\ConsultaResultados; 

Route::get('/', LeadTrivia::class)->name('lead.trivia');

Route::get('/consulta-resultados', ConsultaResultados::class);