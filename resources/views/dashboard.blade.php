<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Minhas Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($reservas->count() > 0)
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($reservas as $reserva)
                                <div class="border rounded-lg p-4 shadow hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold">
                                            {{ $reserva->bemLocavel->modelo }}
                                        </h3>
                                        <span class="px-2 py-1 text-sm rounded {{ $reserva->status === 'confirmado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($reserva->status) }}
                                        </span>
                                    </div>

                                    <div class="text-gray-600">
                                        <p>Check-in: {{ \Carbon\Carbon::parse($reserva->data_inicio)->format('d/m/Y') }}</p>
                                        <p>Check-out: {{ \Carbon\Carbon::parse($reserva->data_fim)->format('d/m/Y') }}</p>
                                        <p class="font-semibold mt-2">Total: €{{ number_format($reserva->preco_total, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginação -->
                        <div class="mt-6 bg-white">
                            {{ $reservas->links() }}
                        </div>
                    @else
                        <p class="text-dark-500 text-center">Você ainda não possui reservas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="max-w-sm mx-auto p-5">
            <div class="alert alert-success shadow-lg rounded-lg py-4 px-6 font-semibold text-green-800 bg-green-100 ring-1 ring-green-300">
                {{ session('success') }}
            </div>
        </div>
    @endif
</x-app-layout>
