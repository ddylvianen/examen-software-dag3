<x-app-layout>
    <div class="min-h-screen bg-gray-100 p-4 sm:p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-4 sm:p-6">
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
            <!-- Titel -->
            <h1 class="text-xl sm:text-2xl font-semibold underline mb-6">
                Product Details {{ $product->productnaam }}
            </h1>

            <!-- Tabel - Responsive Design -->
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full border-collapse">
                    <tbody class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-700 text-sm sm:text-base w-1/2 sm:w-1/3">Productnaam</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-sm sm:text-base">{{ $product->productnaam }}</td>
                        </tr>

                        <tr>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-700 text-sm sm:text-base">Houdbaarheidsdatum</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-sm sm:text-base">
                                {{ $product->houdbaarheidsdatum }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-700 text-sm sm:text-base">Barcode</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-sm sm:text-base">{{ $product->barcode }}</td>
                        </tr>

                        <tr>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-700 text-sm sm:text-base">Magazijn locatie</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-sm sm:text-base">
                                {{ $product->magazijn }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-700 text-sm sm:text-base">Ontvangstdatum</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-sm sm:text-base">
                                {{ $product->ontvangstdatum }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-700 text-sm sm:text-base">Uitleveringsdatum</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-sm sm:text-base">
                                {{ $product->uitleveringsdatum ?? "GEEN" }}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-700 text-sm sm:text-base">Aantal op voorraad</td>
                            <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-sm sm:text-base">
                                {{ $product->aantal }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Buttons - Responsive Layout -->
            <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 mt-6">
                <a href="{{ route('voorraad.edit', $product->product_id) }}"
                class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md font-semibold text-center">
                    Wijzig
                </a>

                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ url()->previous() }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md font-semibold text-center">
                        terug
                    </a>

                    <a href="{{ route('welcome') }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-md font-semibold text-center">
                        home
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>