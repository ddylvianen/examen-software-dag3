<x-app-layout>
    {{-- Update Formulier Container --}}
    <div class="w-[90%] mx-auto mt-12 p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-lg">
        <h2 class="text-2xl font-bold underline text-[#109904] dark:text-[#4ade80] mb-6">Wijzig Product</h2>

        {{-- Success Melding --}}
        @if (session('success'))
            <div class="mb-6 bg-[#d1e7dd] border border-[#badbcc] text-[#0f5132] px-4 py-3 rounded relative dark:bg-green-900/30 dark:border-green-600 dark:text-green-200" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Foutmelding --}}
        @if (session('error'))
            <div class="mb-6 bg-[#f8d7da] border border-[#f5c6cb] text-[#721c24] px-4 py-3 rounded relative dark:bg-red-900/30 dark:border-red-600 dark:text-red-200" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Formulier Start --}}
        <form method="POST" action="{{ route('leveranciers.update') }}">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $product->Id }}">

            {{-- Input Veld voor Datum --}}
            <div class="mb-6 grid grid-cols-1 md:grid-cols-[200px_1fr] gap-4 items-center">
                <label for="houdbaarheidsdatum" class="font-bold text-gray-700 dark:text-gray-200">Houdbaarheidsdatum:</label>
                <div>
                    <input type="date" id="houdbaarheidsdatum" name="houdbaarheidsdatum"
                           value="{{ old('houdbaarheidsdatum', \Carbon\Carbon::parse($product->Houdbaarheidsdatum)->format('Y-m-d')) }}"
                           class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full md:w-auto">

                    @error('houdbaarheidsdatum')
                        <div class="text-red-600 dark:text-red-400 mt-2 text-sm font-medium">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Knoppen Sectie --}}
            <div class="flex justify-between items-center mt-8">
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    Wijzig Houdbaarheidsdatum
                </button>

                <div class="flex gap-2">
                    <a href="{{ route('leveranciers.show', $product->LeverancierId ?? 1) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Terug</a>
                    <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Home</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
