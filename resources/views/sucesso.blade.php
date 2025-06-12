<x-app-layout>
    <div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded shadow">
        <div class="text-center">
            <h2 class="text-xl text-green-600 font-semibold mb-2">✔️ Transação concluída com sucesso!</h2>
            <div class="bg-orange-300 text-white py-4 px-6 rounded-lg mb-6">
                <h1 class="text-2xl font-bold">Pagamento Confirmado</h1>
                <p class="text-sm mt-1">Sua transação foi processada com sucesso</p>
            </div>

            <div class="text-left text-gray-700 mb-6 space-y-2">
                <p><strong>Nome:</strong> {{ $userNome ?? 'Cliente' }}</p>
                <p><strong>Acomodação :</strong> {{ $bemLocavel->modelo }}</p>
                <p><strong>Valor Pago :</strong> {{ $valor }}</p>
                <p><strong>N. Reserva :</strong> {{ $reservaId }}</p>


            </div>


            <form method="GET" action="{{ route('send.email') }}" onsubmit="showRedirectMessage(event)">
                @csrf
                <div class="relative inline-block">
                    <button type="submit"
                        class="w-full bg-orange-300 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow transition duration-200 ease-in-out mt-4">
                        Quero receber o comprovante por email
                    </button>
                </div>
            </form>


            <div id="redirectMessage"
                class="fixed top-0 left-0 w-full bg-green-500 text-white py-4 text-center transform -translate-y-full transition-transform duration-300">
                <p class="text-lg font-semibold">Email enviado com sucesso!</p>
                <p>Redirecionando para o Dashboard em alguns segundos...</p>
            </div>


        </div>
    </div>

    <script>
        function showRedirectMessage(event) {
            event.preventDefault();
            const form = event.target;
            const message = document.getElementById('redirectMessage');


            message.classList.remove('-translate-y-full');


            fetch(form.action, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            }).then(() => {

                setTimeout(() => {
                    window.location.href = "{{ route('dashboard') }}";
                }, 3000);
            });
        }
    </script>
</x-app-layout>
