<div class="f2r-container">
    @if ($step === 1)
        <div class="top-logo">
            <img src="{{ asset('assets/mobil-logo-TM-white.png') }}" alt="Logo" class="logo">
            <p>Reto para vivir al máximo con Mobil™</p>
        </div>
        <form wire:submit.prevent="submitLead" class="f2r-form">
            <input type="text" wire:model="nombre" placeholder="Nombre" class="f2r-input" required>
            <input type="number" wire:model="telefono" placeholder="Teléfono" class="f2r-input" required>
            <button type="submit" class="f2r-btn f2r-btn-primary">Jugar</button>
        </form>
    @elseif($step === 2)
        @if ($showResult)
            <div class="f2r-modal-overlay">
                <div class="f2r-modal">
                    @if ($allCorrect)
                        <h2 class="f2r-modal-title">¡Felicidades!</h2>
                        <p class="f2r-modal-text">Respondiste correctamente todas las preguntas.</p>
                    @else
                        <h2 class="f2r-modal-title">Sigue intentando</h2>
                        <p class="f2r-modal-text">No respondiste todas las preguntas correctamente.</p>
                    @endif
                    <button wire:click="restart" class="f2r-btn f2r-btn-primary f2r-modal-btn">Aceptar</button>
                </div>
            </div>
        @else
            <div class="f2r-question-block">
                <div class="img-container-question">
                    <img src="{{ asset('assets/' . $questions[$current]['category'] . '.png') }}"
                        alt="Imagen de la pregunta" class="f2r-question-img">
                    <p class="f2r-question-text">{{ $questions[$current]['question'] }}</p>
                </div>
                <div class="f2r-options">
                    @foreach ($questions[$current]['options'] as $key => $option)
                        <button wire:click="answer('{{ $key }}')" class="f2r-btn f2r-btn-option">
                            {{ $option }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>
