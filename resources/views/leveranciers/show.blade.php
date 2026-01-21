<x-app-layout>
    {{-- Container voor de detailpagina --}}
    <div
        class="w-[90%] mx-auto mt-12 p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-lg">
        <h2 class="text-2xl font-bold underline text-[#109904] dark:text-[#4ade80] mb-6">Overzicht producten</h2>

        {{-- Leverancier Details Sectie --}}
        <div class="mb-12 border border-gray-200 dark:border-gray-700 rounded-md overflow-hidden max-w-2xl">
            <div class="grid grid-cols-[200px_1fr] border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="p-3 font-bold text-gray-700 dark:text-gray-200 border-r border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">Naam:</div>
                <div class="p-3 text-gray-600 dark:text-gray-300">{{ $leverancier->LeverancierNaam ?? '~~~~' }}</div>
            </div>
            <div class="grid grid-cols-[200px_1fr] border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="p-3 font-bold text-gray-700 dark:text-gray-200 border-r border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">Leveranciernummer:</div>
                <div class="p-3 text-gray-600 dark:text-gray-300">{{ $leverancier->LeverancierNummer ?? '~~~~' }}</div>
            </div>
            <div class="grid grid-cols-[200px_1fr] bg-white dark:bg-gray-800">
                <div class="p-3 font-bold text-gray-700 dark:text-gray-200 border-r border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">Leveranciertype:</div>
                <div class="p-3 text-gray-600 dark:text-gray-300">{{ $leverancier->LeverancierType ?? '~~~~' }}</div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 dark:border-gray-700 text-left text-sm">
                <thead>
                    <tr class="bg-[#f2f2f2] dark:bg-gray-700">
                        <th
                            class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">
                            Naam</th>
                        <th
                            class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">
                            Soort Allergie</th>
                        <th
                            class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">
                            Barcode</th>
                        <th
                            class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">
                            Houdbaarheidsdatum</th>

                        {{-- Wijzig kolom header --}}
                        <th
                            class="border border-gray-200 dark:border-gray-600 p-2 font-bold text-gray-700 dark:text-gray-200">
                            Wijzig Product</th>

                    </tr>
                </thead>
                <tbody class="text-gray-600 dark:text-gray-300">
                    @foreach ($products as $p)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $p->Naam }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">
                                {{ $p->SoortAllergie ?? '~~~~' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">{{ $p->Barcode ?? '~~~~' }}</td>
                            <td class="border border-gray-200 dark:border-gray-600 p-2">
                                {{ $p->Houdbaarheidsdatum ?? '~~~~' }}</td>

                            {{-- Actie knoppen kolom --}}
                            <td
                                class="border border-gray-200 dark:border-gray-600 p-2 text-center text-blue-600 dark:text-blue-400">
                                @if(Auth::user()->hasRole('Manager'))
                                    <a href="{{ route('leveranciers.update.form', $p->Id) }}"
                                        class="inline-block text-xl"><i class="bi bi-pencil-square"></i></a>
                                @else
                                    <span class="text-gray-400">Niet toegestaan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    {{-- Geen resultaten --}}
                    @if (count($products) == 0)
                        <tr>
                            <td colspan="5" class="border border-gray-200 dark:border-gray-600 p-4">
                                <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 px-4 py-3 rounded relative dark:bg-yellow-900/30 dark:border-yellow-600 dark:text-yellow-200 text-center"
                                    role="alert">
                                    <span class="block sm:inline">Geen producten gevonden.</span>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


            <div class="mt-4 flex justify-end gap-2">
                <a href="{{ route('leveranciers.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Terug</a>
                <a href="{{ route('home') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Home</a>
            </div>
        </div>
    </x-app-layout>
