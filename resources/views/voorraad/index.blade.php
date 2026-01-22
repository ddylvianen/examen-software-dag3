<x-app-layout>
    <div class="p-6">
            <div class="pl-2 sm:pl-4">
                @if (session('success'))
                    <div class="p-4 border border-green-600 bg-green-900/50 text-white rounded-lg mt-1 shadow-xl mb-5" role="alert">
                        <h6 class="font-bold">{{ session('success') }}</h6>
                    </div>
                    <meta http-equiv="refresh" content="2;url={{ route('voorraad.index') }}">
                @endif
            </div>
            <div class="pl-2 sm:pl-4">
                @if (session('error'))
                    <div class="p-4 border border-red-600 bg-red-900/50 text-white rounded-lg mt-1 shadow-xl mb-5" role="alert">
                        <h6 class="font-bold">{{ session('error') }}</h6>
                    </div>
                    <meta http-equiv="refresh" content="2;url={{ route('voorraad.index') }}">
                @endif
            </div>

        <div class="flex justify-center mb-6">
            <div class="w-full max-w-6xl">

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <h1 class="text-2xl font-semibold underline">
                        Overzicht Productvoorraden
                    </h1>

                    <div class="flex gap-2">
                        <form action="{{ route('voorraad.ProductenPerCategorie') }}" method="GET" class="flex gap-2">
                            <select
                                name="categorieid"
                                class="rounded-md border border-gray-400 bg-gray-200 text-gray-900 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            >
                                <option value="">Selecteer Categorie</option>
                                @forelse ($categorieen as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->naam }}</option>
                                @empty
                                    <option value="">Nog geen categorieen</option>
                                @endforelse
                            </select>

                            <button
                                type="submit"
                                class="rounded-md bg-gray-700 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600"
                            >
                                Toon Voorraad
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto flex justify-center">
            <table class="w-full max-w-6xl border-collapse border border-gray-300 dark:border-gray-600 dark:border-gray-700 text-left text-xs sm:text-sm">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">
                            Product
                        </th>
                        <th class="hidden sm:table-cell border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">
                            Categorie
                        </th>
                        <th class="hidden md:table-cell border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">
                            Eenheid
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">
                            Aantal
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">
                            Houdbaar
                        </th>
                        <th class="hidden sm:table-cell border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200">
                            Magazijn
                        </th>
                        <th class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-bold text-gray-700 dark:text-gray-200 text-center">
                            Details
                        </th>
                    </tr>
                </thead>

                <tbody class="text-gray-800 dark:text-gray-300">
                    @forelse ($voorraden as $voorraad)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">

                            <td class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 font-medium">
                                {{ $voorraad->productnaam }}
                            </td>

                            <td class="hidden sm:table-cell border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3">
                                {{ $voorraad->categorie }}
                            </td>

                            <td class="hidden md:table-cell border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3">
                                {{ $voorraad->eenheid }}
                            </td>

                            <td class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3">
                                {{ $voorraad->aantal }}
                            </td>

                            <td class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 text-xs sm:text-sm">
                                {{ \Carbon\Carbon::parse($voorraad->houdbaarheidsdatum)->format('d-m-Y') }}
                            </td>

                            <td class="hidden sm:table-cell border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3">
                                {{ $voorraad->magazijn }}
                            </td>

                            <td class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-2 sm:p-3 text-center text-blue-600 dark:text-blue-400">
                                <a href="{{ route('voorraad.show', $voorraad->product_id) }}"
                                class="inline-block text-lg sm:text-xl hover:text-blue-800 dark:hover:text-blue-300"
                                title="Bekijk voorraad">
                                    <i class="bi bi-box-seam"></i>
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border border-gray-300 dark:border-gray-600 dark:border-gray-600 p-4">
                                <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 px-4 py-3 rounded relative dark:bg-yellow-900/30 dark:border-yellow-600 dark:text-yellow-200 text-center text-sm">
                                    Geen producten gevonden in deze categorie.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Home knop -->
        <div class="flex justify-center mt-6">
            <div class="w-full max-w-6xl flex justify-end">
                <a
                    href="{{ route('welcome') }}"
                    class="rounded-md bg-gray-700 px-6 py-2 text-sm font-semibold text-white hover:bg-gray-600 transition"
                >
                    home
                </a>
            </div>
        </div>


    </div>
</x-app-layout>