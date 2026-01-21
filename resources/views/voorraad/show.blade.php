<x-app-layout>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">

            <!-- Titel -->
            <h1 class="text-2xl font-semibold text-white underline mb-6">
                Product Details {{ $product->productnaam }}
            </h1>

            <!-- Tabel -->
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="min-w-full border-collapse">
                    <tbody class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-700 w-1/3">Productnaam</td>
                            <td class="px-6 py-4 text-gray-600">{{ $product->productnaam }}</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-700">Houdbaarheidsdatum</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->houdbaarheidsdatum }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-700">Barcode</td>
                            <td class="px-6 py-4 text-gray-600">{{ $product->barcode }}</td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-700">Magazijn locatie</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->magazijn }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-700">Ontvangstdatum</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->ontvangstdatum }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-700">Uitleveringsdatum</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->uitleveringsdatum ?? "GEEN" }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 font-semibold text-gray-700">Aantal op voorraad</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->aantal }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center mt-6">
                {{-- <a href="{{ route('producten.edit', $product->id ?? 0) }}"
                class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md font-semibold">
                    Wijzig
                </a> --}}

                <div class="space-x-2">
                    <a href="{{ url()->previous() }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md font-semibold">
                        terug
                    </a>

                    {{-- <a href="{{ route('dashboard') }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md font-semibold">
                        home
                    </a> --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>