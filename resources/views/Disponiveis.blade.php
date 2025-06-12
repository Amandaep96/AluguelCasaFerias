<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casas em Destaque</title>
      <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="beige-light">
   @include('layouts.navigation')
<main>
    <!-- Barra de filtro -->
    <section class="pt-[70px] relative">
        <div class="bg-gradient-to-r from-white via-gray-50 to-white shadow-lg rounded-xl p-6 mb-2 border border-gray-100">
            <form action="{{ route('disponiveis') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">



                <!-- Data de Chegada -->
                <div>
                    <label for="data_inicio" class="block text-sm font-semibold text-gray-700 mb-1">
                        📅 Data de Chegada
                    </label>
                    <input type="date" id="data_inicio" name="data_inicio" value="{{ request('data_inicio') }}"
                        min="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-dark focus:border-purple-dark shadow-sm"
                        required>
                </div>

                <!-- Data de Saída -->
                <div>
                    <label for="data_fim" class="block text-sm font-semibold text-gray-700 mb-1">
                        📆 Data de Saída
                    </label>
                    <input type="date" id="data_fim" name="data_fim" value="{{ request('data_fim') }}"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-dark focus:border-purple-dark shadow-sm"
                        required>
                </div>

                <!-- Número de Hóspedes -->
                <div>
                    <label for="hospedes" class="block text-sm font-semibold text-gray-700 mb-1">
                        👥 Número de Hóspedes
                    </label>
                    <select id="hospedes" name="hospedes"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-dark focus:border-purple-dark shadow-sm">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ request('hospedes') == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i == 1 ? 'hóspede' : 'hóspedes' }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Botão -->
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-purple-light hover:bg-purple-dark text-black font-semibold px-6 py-2 rounded-md transition duration-300 flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="purple-dark" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Verificar Disponibilidade
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="mt-2 relative h-[45vh]">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Casas de Férias</h1>

            @if ($bens->isEmpty())
                <div class="text-center text-gray-600">No properties available</div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($bens as $bem)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 cursor-pointer"
                            onclick="openModal({{ $bem->id }})" role="button" tabindex="0">
                            <div class="relative aspect-w-16 aspect-h-9">
                                <img src="{{ $bem->imageUrl ?? 'https://images.unsplash.com/photo-1653569511862-8a0320ae66cc?q=80&w=1936&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                                    alt="{{ $bem->modelo }}"
                                    class="w-full h-48 object-cover hover:opacity-90 transition-opacity duration-300"
                                    onerror="this.onerror=null; this.src='https://unsplash.com/pt-br/fotografias/roupa-de-cama-branca-perto-da-cortina-marrom-da-janela-Fk9d0cxYqC4'"
                                    loading="lazy">
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $bem->modelo }}</h3>
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-600">{{ $bem->numero_hospedes }} hóspedes</span>
                                </div>
                                <div class="text-lg font-bold text-purple-light">
                                    {{ number_format($bem->preco_diario, 2, ',', '.') }} € <span
                                        class="text-sm font-normal text-gray-600">/por noite</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div id="propertyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4">
            <img id="modalImagem" src="" alt="Property Image" class="w-full h-64 object-cover rounded-lg mb-4"
                onerror="this.onerror=null; this.src='https://unsplash.com/pt-br/fotografias/roupa-de-cama-branca-perto-da-cortina-marrom-da-janela-Fk9d0cxYqC4'">
            <h2 id="modalTitulo" class="text-2xl font-bold mb-4"></h2>

            <div class="flex gap-x-8 items-center text-gray-600 mb-4">
                <!-- Par 1: Ícone + Texto: Número de Hóspedes -->
                <div class="flex items-center gap-x-1">
                    <svg class="w-5 h-5" fill="purple-dark" viewBox="0 0 20 20">
                        <path
                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    <span id="modalHospedes" class="text-sm sm:text-base md:text-lg"></span>
                </div>

                <!-- Par 2: Número de Casas de Banho -->
                <div class="flex items-center gap-x-1">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="purple-dark" viewBox="0 0 24 24">
                        <circle cx="8" cy="17" r="1" />
                        <circle cx="12" cy="17" r="1" />
                        <circle cx="16" cy="17" r="1" />
                        <path d="M13,5.08V3h-2v2.08C7.61,5.57,5,8.47,5,12v2h14v-2C19,8.47,16.39,5.57,13,5.08z" />
                        <circle cx="8" cy="20" r="1" />
                        <circle cx="12" cy="20" r="1" />
                        <circle cx="16" cy="20" r="1" />
                    </svg>
                    <span id="modalCasaBanho" class="text-sm sm:text-base md:text-lg"></span>
                </div>

                <!-- Par 3: Número de Camas -->
                <div class="flex items-center gap-x-1">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="purple-dark" viewBox="0 0 24 24">
                        <path
                            d="M7 13c1.66 0 3-1.34 3-3S8.66 7 7 7s-3 1.34-3 3 1.34 3 3 3zM19 7h-8v7H3V5H1v15h2v-3h18v3h2v-9c0-2.21-1.79-4-4-4z" />
                    </svg>
                    <span id="modalNumeroCamas" class="text-sm sm:text-base md:text-lg"></span>
                </div>
            </div>

            <p id="modalPreco" class="text-2xl font-bold text-purple-light mb-4"></p>
            <button onclick="closeModal()">
                <a href="{{ route('reserva.create', ['id' => $bem->id, 'data_inicio' => request('data_inicio'), 'data_fim' => request('data_fim')]) }}"
                    class="border-2 bg-orange-dark text-black px-6 py-2 rounded-lg bg-transparent hover:bg-orange-light hover:border-orange-light transition-colors duration-300">
                    Reservar
                </a>

            </button>
        </div>
    </div>


    <script>
        // Array para armazenar dados das propriedades para uso no modal
        const properties = @json($bens);

        function openModal(id) {
            const property = properties.find(p => p.id === id);

            if (!property) return;
            document.getElementById('modalImagem').src = property.imageUrl ||
                'https://images.unsplash.com/photo-1584132915807-fd1f5fbc078f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
            document.getElementById('modalTitulo').textContent = property.modelo;
            document.getElementById('modalHospedes').textContent = `${property.numero_hospedes} hóspedes`;
            document.getElementById('modalCasaBanho').textContent = `${property.numero_casas_banho} casas de banho`;
            document.getElementById('modalNumeroCamas').textContent = `${property.numero_camas} camas`;
            document.getElementById('modalPreco').innerHTML =
                `${property.preco_diario.toLocaleString('pt-PT', {minimumFractionDigits: 2, maximumFractionDigits: 2}).replace('.', ',')} € <span class="text-sm font-normal text-gray-600">/por noite</span>`;

            document.getElementById('propertyModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Impede o scroll quando o modal está aberto
        }

        function closeModal() {
            document.getElementById('propertyModal').classList.add('hidden');
            document.body.style.overflow = ''; // Restaura o scroll
        }

        // Fecha o modal clicando fora dele
        document.getElementById('propertyModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });


        // Seleciona os campos de data
        const dataInicio = document.getElementById('data_inicio');
        const dataFim = document.getElementById('data_fim');

        // Atualiza o mínimo de data_fim automaticamente
        dataInicio.addEventListener('change', () => {
            const dataSelecionada = new Date(dataInicio.value);
            dataSelecionada.setDate(dataSelecionada.getDate() + 1); // Define mínimo para um dia depois

            // Define a data mínima no formato correto automaticamente
            dataFim.min = dataSelecionada.toISOString().split("T")[0];

            // Ajusta a data de saída se estiver antes do mínimo permitido
            if (dataFim.value < dataFim.min) {
                dataFim.value = dataFim.min;
            }
        });

    </script>
 </main>
</body>
</html>
