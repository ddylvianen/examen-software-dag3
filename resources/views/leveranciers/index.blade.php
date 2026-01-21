<x-app-layout>
    {{-- Container voor de pagina inhoud --}}
    <div class="w-[90%] mx-auto mt-12 p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-lg">

        {{-- Header en Filter Sectie --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold underline text-[#109904] dark:text-[#4ade80]">Overzicht Leveranciers</h2>

            {{-- Filter Formulier --}}
            <form method="GET" action="{{ route('leveranciers.index') }}" class="flex gap-2">
                <select name="leveranciertype" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Selecteer Leveranciertype</option>
                    @foreach($leverancierTypes as $type)
                        <option value="{{ $type->LeverancierType }}" {{ (request('leveranciertype') == $type->LeverancierType || $leverancierType == $type->LeverancierType) ? 'selected' : '' }}>
                            {{ $type->LeverancierType }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition">
                    Toon Leveranciers
                </button>
            </form>
        </div>

        {{-- Tabel met Leveranciers --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 dark:border-gray-700 text-left text-sm">
                <thead>
                    <tr class="bg-[#f2f2f2] dark:bg-gray-700">
                        <th class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">Naam</th>
                        <th class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">Contactpersoon</th>
                        <th class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">Email</th>
                        <th class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">Mobiel</th>
                        <th class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">Leveranciernummer</th>
                        <th class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">LeverancierType</th>
                        <th class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">Product Details</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 dark:text-gray-300">
                    {{-- Loop door leveranciers --}}
                    @forelse($leveranciers as $leverancier)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $leverancier->Naam }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $leverancier->ContactPersoon ?? 'NNNN' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $leverancier->Email ?? 'NNNN' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $leverancier->Mobiel ?? 'NNNN' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $leverancier->LeverancierNummer ?? 'NNNN' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $leverancier->LeverancierType ?? 'NNNN' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2 text-center text-blue-600 dark:text-blue-400 font-bold">
                                {{-- Link naar detail pagina --}}
                                <a href="{{ route('leveranciers.show', $leverancier->Id) }}" class="hover:underline">
                                    <i class="bi bi-journal-text to-blue-900"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        {{-- Geen resultaten --}}
                        <tr>
                            <td colspan="7" class="border border-gray-200 dark:border-gray-600 p-4">
                                <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 px-4 py-3 rounded relative dark:bg-yellow-900/30 dark:border-yellow-600 dark:text-yellow-200 text-center" role="alert">
                                    <span class="block sm:inline">Er zijn geen leveranciers bekent van het geselecteerde leverancierstype</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-end">
            <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Home</a>
        </div>
    </div>
</x-app-layout>

