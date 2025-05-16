{{-- filepath: resources/views/livewire/lead-trivia.blade.php --}}
<div class="max-w-md mx-auto mt-10">
    @if($step === 1)
        <form wire:submit.prevent="submitLead" class="space-y-4">
            <input type="text" wire:model="nombre" placeholder="Nombre" class="block w-full border rounded p-2" required>
            <input type="text" wire:model="cedula" placeholder="Cédula" class="block w-full border rounded p-2" required>
            <input type="text" wire:model="telefono" placeholder="Teléfono" class="block w-full border rounded p-2" required>
            <input type="email" wire:model="correo" placeholder="Correo" class="block w-full border rounded p-2" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Comenzar Trivia</button>
        </form>
    @elseif($step === 2)
        @if($showResult)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded shadow text-center">
                    @if($allCorrect)
                        <h2 class="text-2xl font-bold mb-4">¡Felicidades!</h2>
                        <p>Respondiste correctamente todas las preguntas.</p>
                    @else
                        <h2 class="text-2xl font-bold mb-4">Sigue intentando</h2>
                        <p>No respondiste todas las preguntas correctamente.</p>
                    @endif
                    <button wire:click="restart" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Aceptar</button>
                </div>
            </div>
        @else
            <div>
                <h2 class="text-xl font-bold mb-4">Pregunta {{ $current + 1 }} de {{ count($questions) }}</h2>
                <p class="mb-4">{{ $questions[$current]['question'] }}</p>
                @foreach($questions[$current]['options'] as $key => $option)
                    <button wire:click="answer('{{ $key }}')" class="block w-full mb-2 bg-gray-200 p-2 rounded">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        @endif
    @endif
</div>