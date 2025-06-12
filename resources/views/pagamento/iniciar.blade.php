<x-app-layout>
    <div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded shadow">
        <div class="text-center">
            <h2 class="text-xl text-green-600 font-semibold mb-2"> Dados da transação</h2>
            <div class="bg-orange-300 text-white py-4 px-6 rounded-lg mb-6">
                <h1 class="text-2xl font-bold">Pagamento em espera</h1>
                <p class="text-sm mt-1">Sua transação depende de pagamento</p>
            </div>

            <div class="text-left text-gray-700 mb-6 space-y-2">
                <p><strong>Valor Pago:</strong> €{{ number_format($valor, 2, ',', '.') }}</p>
                <p><strong>Nome:</strong> {{ $userNome ?? 'Cliente' }}</p>
                <p><strong>Data da Transação:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>


                <p><strong>Dias:</strong> {{ $numero_dias }}</p>
                <p><strong>Ref:</strong> {{ $referencia }}</p>
                <p><strong>Entidade:</strong> {{ $entidade }}</p>
                <p><strong>modelo:</strong> {{ $bemLocavel }}</p>

            </div>

             <form method="GET" action="{{ route('disponiveis') }}">
                @csrf

                <button type="submit"
                    class="w-full bg-orange-300 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow transition duration-200 ease-in-out mt-4">
                    Voltar para a Pagina de reservas
                </button>
            </form>

            <form method="POST" action="{{ route('reserva.store') }}">
                @csrf

                <button type="submit"
                    class="w-full bg-orange-300 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow transition duration-200 ease-in-out mt-4">
                    Confirmar pagamento
                </button>
            </form>


        </div>
    </div>
</x-app-layout>
