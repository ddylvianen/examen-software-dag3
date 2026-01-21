<x-app-layout>
    <div class="p-6">

        <!-- Titel + filters -->
        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h1 class="text-2xl font-semibold text-white underline">
                Overzicht Productvoorraden
            </h1>

            <div class="flex gap-2">
                <form action="{{ route('voorraad.ProductenPerCategorie') }}" method="GET">
                    <select
                        name="categorieid"
                        class="rounded-md border border-gray-300 py-2 text-sm focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500"
                    >
                        <option value="">Selecteer Categorie</option>
                        @forelse ($categorieen as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->naam }}</option>
                        @empty
                            <option value="">Nog geen categorieen geregistreerd</option>
                        @endforelse
                    </select>

                    <button
                        type="submit"
                        class="rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-500"
                    >
                        Toon Voorraad
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full border-collapse bg-white text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Productnaam</th>
                        <th class="px-6 py-3 font-semibold">Categorie</th>
                        <th class="px-6 py-3 font-semibold">Eenheid</th>
                        <th class="px-6 py-3 font-semibold">Aantal</th>
                        <th class="px-6 py-3 font-semibold">Houdbaarheidsdatum</th>
                        <th class="px-6 py-3 font-semibold">Magazijn</th>
                        <th class="px-6 py-3 font-semibold text-center">Voorraad Details</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($voorraden as $voorraad)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $voorraad->productnaam }}</td>
                        <td class="px-6 py-4">{{ $voorraad->categorie }}</td>
                        <td class="px-6 py-4">{{ $voorraad->eenheid }}</td>
                        <td class="px-6 py-4">{{ $voorraad->aantal }}</td>
                        <td class="px-6 py-4">{{ $voorraad->houdbaarheidsdatum }}</td>
                        <td class="px-6 py-4">{{ $voorraad->magazijn }}</td>
                        <td class="px-6 py-4 text-center">
                            <a
                                href="{{ route('voorraad.show', $voorraad->product_id) }}"
                                class="inline-flex items-center justify-center rounded-md bg-blue-100 p-2 text-blue-600 hover:bg-blue-200"
                                title="Bekijk details"
                            >
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 .087.586l2.977-7.937A1 1 0 0 1 6 10h12V9a2 2 0 0 0-2-2h-4.532l-1.9-2.28A2 2 0 0 0 8.032 4H4Zm2.693 8H6.5l-3 8H18l3-8H6.693Z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td class="p-4" colspan="7">
                                <div class="w-full text-center p-4 bg-orange-500/50 border border-orange-500 rounded">
                                    er zijn geen producten bekent die behoren bij de geselecteerde productcategorie
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Home knop -->
        <div class="mt-6 flex justify-end">
            {{-- <a
                href="{{ route('home') }}"
                class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white hover:bg-blue-500"
            >
                home
            </a> --}}
        </div>

    </div>
</x-app-layout>