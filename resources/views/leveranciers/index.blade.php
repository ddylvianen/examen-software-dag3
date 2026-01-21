<x-app-layout>
    {{-- Container voor de pagina inhoud --}}
    <div class="w-full md:w-[90%] mx-auto mt-6 md:mt-12 p-4 md:p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-lg">

        {{-- Header en Filter Sectie --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 md:gap-0 mb-6">
            <h2 class="text-xl md:text-2xl font-bold underline text-[#109904] dark:text-[#4ade80]">Overzicht Leveranciers</h2>

            {{-- Filter Formulier --}}
            <form method="GET" action="{{ route('leveranciers.index') }}" class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                <select name="leveranciertype" class="flex-1 md:flex-none border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm md:text-base">
                    <option value="">Selecteer Leveranciertype</option>
                    @foreach($leverancierTypes as $type)
                        <option value="{{ $type->LeverancierType }}" {{ (request('leveranciertype') == $type->LeverancierType || $leverancierType == $type->LeverancierType) ? 'selected' : '' }}>
                            {{ $type->LeverancierType }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition text-sm md:text-base">
                    Toon Leveranciers
                </button>
            </form>
        </div>

        {{-- Tabel met Leveranciers --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 dark:border-gray-700 text-left text-xs sm:text-sm">
                <thead>
                    <tr class="bg-[#f2f2f2] dark:bg-gray-700">
                        <th class="border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">Naam</th>
                        <th class="hidden sm:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">Contactpersoon</th>
                        <th class="hidden md:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">Email</th>
                        <th class="hidden lg:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">Mobiel</th>
                        <th class="hidden md:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">Nummer</th>
                        <th class="hidden sm:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">Type</th>
                        <th class="border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200 text-center">Details</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 dark:text-gray-300">
                    {{-- Loop door leveranciers --}}
                    @forelse($leveranciers as $leverancier)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="border border-gray-200 dark:border-gray-600 p-2 sm:p-3 font-medium">{{ $leverancier->Naam }}</td>
                            <td class="hidden sm:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3">{{ $leverancier->ContactPersoon ?? 'NNNN' }}</td>
                            <td class="hidden md:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3 text-xs sm:text-sm">{{ $leverancier->Email ?? 'NNNN' }}</td>
                            <td class="hidden lg:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3">{{ $leverancier->Mobiel ?? 'NNNN' }}</td>
                            <td class="hidden md:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3">{{ $leverancier->LeverancierNummer ?? 'NNNN' }}</td>
                            <td class="hidden sm:table-cell border border-gray-200 dark:border-gray-600 p-2 sm:p-3">{{ $leverancier->LeverancierType ?? 'NNNN' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2 sm:p-3 text-center text-blue-600 dark:text-blue-400 font-bold">
                                {{-- Link naar detail pagina --}}
                                <a href="{{ route('leveranciers.show', $leverancier->Id) }}" class="hover:underline text-lg sm:text-base">
                                    <i class="bi bi-journal-text"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        {{-- Geen resultaten --}}
                        <tr>
                            <td colspan="7" class="border border-gray-200 dark:border-gray-600 p-4">
                                <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 px-4 py-3 rounded relative dark:bg-yellow-900/30 dark:border-yellow-600 dark:text-yellow-200 text-center text-sm" role="alert">
                                    <span class="block">Er zijn geen leveranciers bekent van het geselecteerde leverancierstype</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 md:mt-8 flex justify-center md:justify-end">
            <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-150 ease-in-out text-sm md:text-base">Home</a>
        </div>
    </div>
</x-app-layout>

