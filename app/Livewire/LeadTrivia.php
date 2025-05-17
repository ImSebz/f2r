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
                'question' => '¿Cuál de estas es una propiedad del aceite Mobil 1 Racing 4T 10W-40 / 15W-50?',
                'options' => [
                    'a' => 'Ayuda a prolongar la vida del motor.',
                    'b' => 'Sobrecalienta el motor de tu moto.',
                    'c' => 'Sirve para camiones.',
                ],
                'category' => 'mobil1',
                'correct' => 'a',
            ],
            [
                'question' => '¿Cuál de estas NO una propiedad del aceite Mobil Super Moto 4T MAX 10W-40?',
                'options' => [
                    'a' => 'Se debe cambiar cada 250 kilómetros.',
                    'b' => 'Protege el embrague y la transmisión Minimiza el ruido y vibraciones.',
                    'c' => 'Compatible con motocicletas con tecnologías Euro 3 y anteriores.',
                ],
                'category' => 'mobilsuper',
                'correct' => 'a',
            ],
            [
                'question' => '¿Cuál de estas NO es una propiedad del aceite Mobil Super Moto 4T MX 10W-30?',
                'options' => [
                    'a' => 'Ahorro en el consumo de combustible.',
                    'b' => 'Lubrica mejor si lo mezclas con gasolina.',
                    'c' => 'Protege contra el desgaste y la corrosión.',
                ],
                'category' => 'mobilsupermoto',
                'correct' => 'b',
            ],
            [
                'question' => '¿Cuál de estas NO es una propiedad del aceite Mobil Super Moto 4T MX 10W-40?',
                'options' => [
                    'a' => 'Reduce la fricción logrando una conducción confortable.',
                    'b' => 'Sobrecalienta el motor de tu moto.',
                    'c' => 'Protege contra el desgaste y la corrosión.',
                ],
                'category' => 'mobilsupermotonaranja',
                'correct' => 'b',
            ],
            [
                'question' => '¿Cuál de estas es una propiedad del aceite Mobil Super Moto 4T MX 15W-50?',
                'options' => [
                    'a' => 'Compatible con motocicletas con tecnologías Euro 3 y anteriores.',
                    'b' => 'Sobrecalienta el motor de tu moto.',
                    'c' => 'Recomendado para bicicletas.',
                ],
                'category' => 'mobilsupermotoroja',
                'correct' => 'a',
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
