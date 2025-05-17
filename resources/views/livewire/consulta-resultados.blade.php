{{-- filepath: c:\laragon\www\f2r\resources\views\livewire\consulta-resultados.blade.php --}}
<div>
    <div class="resultados-table-container">
        {{-- <input type="text" wire:model.live="search" placeholder="Buscar por cédula" class="f2r-input"
            style="margin-bottom:20px;width:100%;max-width:350px;"> --}}
        <table class="resultados-table">
            <thead>
                <tr>
                    <th class="resultados-th">Nombre</th>
                    <th class="resultados-th">Teléfono</th>
                    <th class="resultados-th">Trivia Correcta</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leads as $lead)
                    <tr class="resultados-tr">
                        <td class="resultados-td">{{ $lead->nombre }}</td>
                        <td class="resultados-td">{{ $lead->telefono }}</td>
                        <td class="resultados-td">{{ $lead->trivia_correct ? 'Sí' : 'No' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="resultados-td" colspan="5">No hay resultados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
