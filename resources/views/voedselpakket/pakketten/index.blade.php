<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-green-700 dark:text-green-400 underline underline-offset-4">
                        Overzicht Voedselpakketten
                    </h1>

                    @if ($errorMessage)
                        <div class="mt-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            {{ $errorMessage }}
                        </div>
                    @endif

                    @if ($gezin)
                        <div class="mt-6 border border-gray-200 dark:border-gray-700 rounded-md overflow-hidden">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-0">
                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 font-semibold">Naam:</div>
                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">{{ $gezin->Naam }}</div>

                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 font-semibold">Omschrijving:</div>
                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">{{ $gezin->Omschrijving }}</div>

                                <div class="px-4 py-3 font-semibold">Totaal aantal Personen:</div>
                                <div class="px-4 py-3">{{ $gezin->TotaalAantalPersonen }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Pakketnummer</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Datum samenstelling</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Datum uitgifte</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Aantal producten</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Wijzig Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pakketten as $pakket)
                                    <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $pakket->PakketNummer }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">
                                            {{ $pakket->DatumSamenstelling ? \Illuminate\Support\Carbon::parse($pakket->DatumSamenstelling)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">
                                            {{ $pakket->DatumUitgifte ? \Illuminate\Support\Carbon::parse($pakket->DatumUitgifte)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">
                                            @php
                                                $statusLabel = match ($pakket->Status) {
                                                    'NietUitgereikt' => 'Niet Uitgereikt',
                                                    'NietMeerIngeschreven' => 'Niet Meer Ingeschreven',
                                                    default => $pakket->Status,
                                                };
                                            @endphp
                                            {{ $statusLabel }}
                                        </td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $pakket->AantalProducten }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700 text-center">
                                            <a
                                                href="{{ route('voedselpakketten.pakketten.edit', ['voedselpakketId' => $pakket->VoedselpakketId]) }}"
                                                class="inline-flex items-center justify-center text-blue-600 hover:text-blue-800"
                                                aria-label="Wijzig Status"
                                            >
                                                <!-- pencil icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.462 3 21l2.538-5.25L16.862 3.487z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 6l-1.5-1.5" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                            &nbsp;
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('voedselpakketten.gezinnen.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            terug
                        </a>
                        <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

