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
                'question' => 'Moteros, ¿qué representa la marca Mobil™ en el mundo?',
                'options' => [
                    'a' => 'Líder en aceites sintéticos',
                    'b' => 'Marca número 1 en Colombia',
                    'c' => 'Desempeño para vivir al máximo',
                    'd' => 'Todas las anteriores',
                ],
                'category' => 'mobil1',
                'correct' => 'd',
            ],
            [
                'question' => 'Selecciona uno de los beneficios del lubricante Mobil Super™ Moto Scooter MX 10W-40',
                'options' => [
                    'a' => 'Protección a altas temperaturas',
                    'b' => 'Aceleración en terrenos montañosos de 0 a 100 KM en 5 segundos.',
                    'c' => 'Previene el desgaste de los frenos',
                    'd' => 'Ayuda a prevenir caídas',
                ],
                'category' => 'mobilsupermotonaranja',
                'correct' => 'a',
            ],
            [
                'question' => 'Selecciona cuál de las siguientes opciones es parte de la molécula del lubricante Mobil Super™ Moto MX 10W-30',
                'options' => [
                    'a' => 'Proporciona estabilidad al andar en pistas mojadas',
                    'b' => 'Ayuda en el frenado de la moto',
                    'c' => 'Ahorra combustible',
                    'd' => 'Todas las anteriores',
                ],
                'category' => 'mobilsupermoto',
                'correct' => 'c',
            ],
            [
                'question' => 'Sabías que el lubricante Mobil Super™ Moto MX 10W-40 tiene una molécula activa única, ¿cuál es su molécula y su beneficio?',
                'options' => [
                    'a' => 'Molécula antidesgaste termoactivada con excelente protección a altas temperaturas',
                    'b' => 'Previene el desgaste de los frenos',
                    'c' => 'Aceleración de cero a 10km en 5 segundos',
                    'd' => 'Ayuda a prevenir caídas',
                ],
                'category' => 'mobilsuper',
                'correct' => 'a',
            ],
            [
                'question' => 'Selecciona un beneficio de la molécula activa del lubricante Mobil Super™ Moto MX 15W-50',
                'options' => [
                    'a' => 'Mejor agarre en terrenos lluviosos',
                    'b' => 'Ahorra combustible',
                    'c' => 'Previene el desgaste de los neumáticos',
                    'd' => 'Molécula antidesgaste termoactivada con excelente protección a altas temperaturas',
                ],
                'category' => 'mobilsupermotoroja',
                'correct' => 'd',
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
