<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;

class LeadTrivia extends Component
{
    public $step = 1;
    public $nombre, $cedula, $telefono, $correo;
    public $questions = [];
    public $current = 0;
    public $answers = [];
    public $showResult = false;
    public $allCorrect = false;

    protected $rules = [
        'nombre' => 'required',
        'cedula' => 'required',
        'telefono' => 'required',
        'correo' => 'required|email',
    ];

    public function mount()
    {
        $this->questions = [
            [
                'question' => '¿Cuál es la capital de Francia?',
                'options' => ['a' => 'París', 'b' => 'Madrid', 'c' => 'Roma'],
                'correct' => 'a',
            ],
            [
                'question' => '¿Cuánto es 2 + 2?',
                'options' => ['a' => '3', 'b' => '4', 'c' => '5'],
                'correct' => 'b',
            ],
            [
                'question' => '¿Cuál es el océano más grande?',
                'options' => ['a' => 'Atlántico', 'b' => 'Índico', 'c' => 'Pacífico'],
                'correct' => 'c',
            ],
            [
                'question' => '¿Quién escribió "Cien años de soledad"?',
                'options' => ['a' => 'Gabriel García Márquez', 'b' => 'Mario Vargas Llosa', 'c' => 'Julio Cortázar'],
                'correct' => 'a',
            ],
            [
                'question' => '¿Cuál es el planeta más cercano al sol?',
                'options' => ['a' => 'Venus', 'b' => 'Mercurio', 'c' => 'Marte'],
                'correct' => 'b',
            ],
        ];
        shuffle($this->questions);
    }

    public function submitLead()
    {
        $this->validate();
        $this->step = 2;
    }

    public function answer($option)
    {
        $this->answers[$this->current] = $option;
        if ($this->current < count($this->questions) - 1) {
            $this->current++;
        } else {
            $this->checkResult();
        }
    }

    public function checkResult()
    {
        $correct = 0;
        foreach ($this->questions as $i => $q) {
            if (($q['correct'] ?? null) === ($this->answers[$i] ?? null)) {
                $correct++;
            }
        }
        $this->allCorrect = ($correct === count($this->questions));

        Lead::create([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'trivia_correct' => $this->allCorrect,
        ]);

        $this->showResult = true;
    }

    public function restart()
    {
        $this->reset(['step', 'nombre', 'cedula', 'telefono', 'correo', 'current', 'answers', 'showResult', 'allCorrect']);
        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.lead-trivia')
            ->layout('layouts.app');
    }
}
