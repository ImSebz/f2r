<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;

class LeadTrivia extends Component
{
    public $step = 1;
    public $nombre, $telefono;
    public $questions = [];
    public $current = 0;
    public $answers = [];
    public $showResult = false;
    public $allCorrect = false;

    protected $rules = [
        'nombre' => 'required',
        'telefono' => 'required',
    ];

    public function mount()
    {
        $this->questions = [
            [
                'question' => '¿Cuál de estas es una propiedad del aceite Mobil 1 Racing™ 4T 10W-40 / 15W-50?',
                'options' => [
                    'a' => 'Ayuda a prolongar la vida del motor.',
                    'b' => 'Son lubricantes para motores bicilíndricos o en forma de V',
                    'c' => 'Vienen diluidos para facilitar su mezcla al agregarlo al combustible.',
                ],
                'category' => 'mobil1',
                'correct' => 'a',
            ],
            [
                'question' => '¿Cuál de estas NO una propiedad del aceite Mobil Super™ Moto 4T MAX 10W-40?',
                'options' => [
                    'a' => 'Es un lubricante mineral con tecnología premium para motocicletas de 4 tiempos.',
                    'b' => 'Protege el embrague y la transmisión Minimiza el ruido y vibraciones.',
                    'c' => 'Compatible con motocicletas con tecnologías Euro 3 y anteriores.',
                ],
                'category' => 'mobilsuper',
                'correct' => 'a',
            ],
            [
                'question' => '¿Cuál de estas NO es una propiedad del aceite Mobil Super™ Moto 4T MX 10W-30?',
                'options' => [
                    'a' => 'Ahorro en el consumo de combustible.',
                    'b' => 'Es un lubricante semisintético para motocicletas de dos tiempos.',
                    'c' => 'Protege contra el desgaste y la corrosión.',
                ],
                'category' => 'mobilsupermoto',
                'correct' => 'b',
            ],
            [
                'question' => '¿Cuál de estas NO es una propiedad del aceite Mobil Super™ Moto Scooter 4T MX 10W-40?',
                'options' => [
                    'a' => 'Reduce la fricción logrando una conducción confortable.',
                    'b' => 'Es un lubricante con tecnología sintética recomendada para motos eléctricas.',
                    'c' => 'Protege contra el desgaste y la corrosión.',
                ],
                'category' => 'mobilsupermotonaranja',
                'correct' => 'b',
            ],
            [
                'question' => '¿Cuál de estas es una propiedad del aceite Mobil Super™ Moto 4T MX 15W-50?',
                'options' => [
                    'a' => 'Protección a altas temperaturas gracias a la molécula anti-desgaste termo activada.',
                    'b' => 'Con tecnología “clean engine” que ayuda a la limpieza del motor.',
                    'c' => 'Combina aceites minerales con un robusto sistema de aditivos para mayor desempeño en el motor.',
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
            'telefono' => $this->telefono,
            'trivia_correct' => $this->allCorrect,
        ]);

        $this->showResult = true;
    }

    public function restart()
    {
        $this->reset(['step', 'nombre', 'telefono', 'current', 'answers', 'showResult', 'allCorrect']);
        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.lead-trivia')
            ->layout('layouts.app');
    }
}
