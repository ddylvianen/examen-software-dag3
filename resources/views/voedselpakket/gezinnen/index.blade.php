<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-start justify-between gap-6">
                        <h1 class="text-2xl font-semibold text-green-700 dark:text-green-400 underline underline-offset-4">
                            Overzicht gezinnen met voedselpakketten
                        </h1>

                        <form method="GET" action="{{ route('voedselpakketten.gezinnen.index') }}" class="flex items-center gap-3">
                            <select
                                name="eetwensId"
                                class="border border-gray-300 rounded-md px-3 py-2 text-sm bg-white dark:bg-gray-900 dark:border-gray-700"
                            >
                                <option value="">Selecteer Eetwens</option>
                                @foreach ($eetwensen as $eetwens)
                                    <option value="{{ $eetwens->Id }}" @selected((string) $selectedEetwensId === (string) $eetwens->Id)>
                                        {{ $eetwens->Naam }}
                                    </option>
                                @endforeach
                            </select>

                            <button
                                type="submit"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm"
                            >
                                Toon Gezinnen
                            </button>
                        </form>
                    </div>

                    @if ($errorMessage)
                        <div class="mt-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            {{ $errorMessage }}
                        </div>
                    @endif

                    @if ($showEmptyMessage)
                        <div class="mt-6 rounded-md border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm text-yellow-900">
                            Er zijn geen gezinnen bekent die de geselecteerde eetwens hebben
                        </div>
                    @endif

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Gezinsnaam</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Omschrijving</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Volwassenen</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Kinderen</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Babys</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Vertegenwoordiger</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold border-b border-gray-200 dark:border-gray-700">Voedselpakket Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gezinnen as $gezin)
                                    <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-900">
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $gezin->Gezinsnaam }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $gezin->Omschrijving }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $gezin->AantalVolwassenen }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $gezin->AantalKinderen }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $gezin->AantalBabys }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700">{{ $gezin->Vertegenwoordiger }}</td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200 dark:border-gray-700 text-center">
                                            <a
                                                href="{{ route('voedselpakketten.gezinnen.pakketten.index', ['gezinId' => $gezin->GezinId]) }}"
                                                class="inline-flex items-center justify-center text-blue-600 hover:text-blue-800"
                                                aria-label="Voedselpakket Details"
                                            >
                                                <!-- cube icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 16.5V7.5L12 3 3 7.5v9L12 21l9-4.5z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21V12" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9 4.5-9-4.5" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                            &nbsp;
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

