<x-app-layout>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-semibold text-green-600 underline mb-8">
                Wijzig Product Details {{ $product->naam ?? 'Aardappel' }}
            </h1>
                {{-- Titel --}}

                {{-- Form --}}
                {{-- <form method="POST" action="{{ route('producten.update', $product->id ?? 1) }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
                    @csrf
                    @method('PUT') --}}

                    {{-- Productnaam --}}
                    <div>
                        <label class="block font-semibold mb-1">Productnaam</label>
                        <input
                            type="text"
                            name="naam"
                            value="{{ $product->productnaam }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                    </div>

                    {{-- Houdbaarheidsdatum --}}
                    <div>
                        <label class="block font-semibold mb-1">Houdbaarheidsdatum</label>
                        <input
                            type="date"
                            name="houdbaarheidsdatum"
                            value="{{ $product->houdbaarheidsdatum }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2"
                        >
                    </div>

                    {{-- Barcode --}}
                    <div>
                        <label class="block font-semibold mb-1">Barcode</label>
                        <input
                            type="text"
                            name="barcode"
                            value="{{ $product->barcode }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2"
                        >
                    </div>

                    {{-- Magazijn locatie --}}
                    <div>
                        <label class="block font-semibold mb-1">Magazijn Locatie</label>
                        <select
                            name="magazijn_id"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-white"
                        >
                            @forelse($magazijnen as $magazijn)
                                <option
                                    value="{{ $magazijn->Locatie }}"
                                >
                                    {{ $magazijn->Locatie }}
                                </option>
                            @empty
                                <option
                                    value="{{ $magazijn->id }}"
                                >
                                    Geen magazijnen gevonden
                                </option>
                            @endforelse
                        </select>
                    </div>

                    {{-- Ontvangstdatum --}}
                    <div>
                        <label class="block font-semibold mb-1">Ontvangstdatum</label>
                        <input
                            type="date"
                            name="ontvangstdatum"
                            value="{{ $product->ontvangstdatum }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2"
                        >
                    </div>

                    {{-- Aantal uitgeleverd --}}
                    <div>
                        <label class="block font-semibold mb-1">Aantal uitgeleverde producten</label>
                        <input
                            type="number"
                            name="uitgeleverd"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                        >
                    </div>

                    {{-- Uitleveringsdatum --}}
                    <div>
                        <label class="block font-semibold mb-1">Uitleveringsdatum</label>
                        <input
                            type="date"
                            name="uitleveringsdatum"
                            value="{{ $product->uitleveringsdatum ?? '' }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                        >
                    </div>

                    {{-- Aantal op voorraad --}}
                    <div>
                        <label class="block font-semibold mb-1">Aantal op voorraad</label>
                        <input
                            type="number"
                            name="voorraad"
                            value="{{ $product->voorraad ?? '' }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2"
                        >
                    </div>

                    {{-- Acties --}}
                    <div class="md:col-span-2 flex justify-between items-center mt-6">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow"
                        >
                            Wijzig Product Details
                        </button>

                        <div class="flex gap-3">
                            <a
                                href="{{ url()->previous() }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg"
                            >
                                terug
                            </a>
                            {{-- <a
                                href="{{ route('home') }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg"
                            >
                                home
                            </a> --}}
                        </div>
                </form>
            </div>
        </div>
    </div>    
</x-app-layout>