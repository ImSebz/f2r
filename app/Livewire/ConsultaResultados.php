<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;

class ConsultaResultados extends Component
{
    public function render()
    {
        $leads = \App\Models\Lead::all();

        return view('livewire.consulta-resultados', compact('leads'))
            ->layout('layouts.app');
    }
}
