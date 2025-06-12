<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            Reserva para: {{ $bemLocavel->nome ?? ($bemLocavel->modelo ?? 'ddd') }}
        </h2>
        <p class="text-lg text-gray-600 mb-6">
            Preço por diária: <span class="font-semibold text-gray-800">€{{ $bemLocavel->preco_diario ?? 'N/A' }}</span>
        </p>
        <!-- Nova imagem -->
        <img src="{{ $bemLocavel->imageUrl ?? 'https://images.unsplash.com/photo-1584132923901-cd27c0cdd88e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
            alt="{{ $bemLocavel->nome }}" class="mb-4 rounded-lg shadow-md">

        <!-- Detalhes -->
        <div class="text-gray-600 mb-4">
            <p><strong>Características:</strong>
                @if ($bemLocavel->caracteristicas && $bemLocavel->caracteristicas->count())
                    @foreach ($bemLocavel->caracteristicas as $caracteristica)
                        {{ $caracteristica->nome }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @else
                    Nenhuma característica cadastrada.
                @endif
            </p>
            <p><strong>Hóspedes:</strong> {{ $bemLocavel->numero_hospedes }}</p>
            <p><strong>Camas:</strong> {{ $bemLocavel->numero_camas }}</p>
            <p><strong>Casas de banho:</strong> {{ $bemLocavel->numero_casas_banho }}</p>
        </div>

        <form method="GET" action="{{ route('pagamento.processar') }}">
            @csrf

            <div class="mb-4">
                <label for="data_inicio" class="block text-sm font-medium text-gray-700 mb-1">Data de Início</label>
                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>

            <div class="mb-6">
                <label for="data_fim" class="block text-sm font-medium text-gray-700 mb-1">Data de Fim</label>
                <input type="date" name="data_fim" value="{{ request('data_fim') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>
                <input type="hidden" name="bem_locavel_id" value="{{ $bemLocavel->id }}">
                <button type="submit"
                    class="mt-4 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Finalizar Pagamento
                </button>
            </form>

    </div>
</x-app-layout>
