<x-app-layout>
    {{-- Update Formulier Container --}}
    <div class="w-full md:w-[90%] mx-auto mt-6 md:mt-12 p-4 md:p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-lg">
        <h2 class="text-xl md:text-2xl font-bold underline text-[#109904] dark:text-[#4ade80] mb-6">Wijzig Product</h2>

        {{-- Success Melding --}}
        @if (session('success'))
            <div class="mb-6 bg-[#d1e7dd] border border-[#badbcc] text-[#0f5132] px-4 py-3 rounded relative dark:bg-green-900/30 dark:border-green-600 dark:text-green-200 text-sm md:text-base" role="alert">
                <span class="block">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Foutmelding --}}
        @if (session('error'))
            <div class="mb-6 bg-[#f8d7da] border border-[#f5c6cb] text-[#721c24] px-4 py-3 rounded relative dark:bg-red-900/30 dark:border-red-600 dark:text-red-200 text-sm md:text-base" role="alert">
                <span class="block">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Formulier Start --}}
        <form method="POST" action="{{ route('leveranciers.update') }}">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $product->Id }}">

            {{-- Input Veld voor Datum --}}
            <div class="mb-8 grid grid-cols-1 sm:grid-cols-[120px_1fr] md:grid-cols-[150px_1fr] gap-4 items-start sm:items-center">
                <label for="houdbaarheidsdatum" class="font-bold text-gray-700 dark:text-gray-200 text-sm md:text-base">Houdbaarheidsdatum:</label>
                <div class="w-full">
                    <input type="date" id="houdbaarheidsdatum" name="houdbaarheidsdatum"
                           min="{{ now()->toDateString() }}"
                           value="{{ old('houdbaarheidsdatum', \Carbon\Carbon::parse($product->Houdbaarheidsdatum)->format('Y-m-d')) }}"
                           class="w-full md:w-auto border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm md:text-base">

                    @error('houdbaarheidsdatum')
                        <div class="text-red-600 dark:text-red-400 mt-2 text-sm font-medium">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Knoppen Sectie --}}
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-2 mt-8">
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-md transition duration-150 ease-in-out text-sm md:text-base w-full sm:w-auto">
                    Wijzig Houdbaarheidsdatum
                </button>

                <div class="flex flex-col sm:flex-row gap-2 ml-auto">
                    <a href="{{ route('leveranciers.show', $product->LeverancierId ?? 1) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-150 ease-in-out text-sm md:text-base text-center">Terug</a>
                    <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-150 ease-in-out text-sm md:text-base text-center">Home</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
