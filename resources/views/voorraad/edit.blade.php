<x-app-layout>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-semibold text-green-600 underline mb-8">
                Wijzig Product Details {{ $product->naam ?? 'Aardappel' }}
            </h1>
                {{-- Titel --}}

                {{-- Form --}}
                <form method="POST" action="{{ route('voorraad.update', ['id' => $product->product_id]) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold mb-1">Productnaam</label>
                        <input
                            type="text"
                            name="Productnaam"
                            value="{{ $product->productnaam }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Houdbaarheidsdatum</label>
                        <input
                            type="date"
                            name="Houdbaarheidsdatum"
                            value="{{ $product->houdbaarheidsdatum }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Barcode</label>
                        <input
                            type="text"
                            name="Barcode"
                            value="{{ $product->barcode }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Magazijn Locatie</label>
                        <select
                            name="MagazijnId"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-white"
                        >
                            @forelse($magazijnen as $magazijn)
                                <option
                                    value="{{ $magazijn->MagazijnId }}"
                                    @if($magazijn->MagazijnId == $product->magazijn_relatie_id) selected @endif
                                >
                                    {{ $magazijn->Locatie }}
                                </option>
                            @empty
                                <option
                                    value=""
                                >
                                    Geen magazijnen gevonden
                                </option>
                            @endforelse
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Ontvangstdatum</label>
                        <input
                            type="date"
                            name="Ontvangstdatum"
                            value="{{ $product->ontvangstdatum }}"
                            class="w-full rounded-lg bg-blue-50 border border-gray-300 px-4 py-2"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Aantal uitgeleverde producten</label>
                        <input 
                            type="number"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-white"                        
                            name="Uitgeleverd" 
                            value="0"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Uitleveringsdatum</label>
                        <input
                            type="date"
                            name="Uitleveringsdatum"
                            value="{{ $product->uitleveringsdatum }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Aantal op voorraad</label>
                        <input 
                            type="number" 
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-white"
                            name="Aantal" 
                            value="{{ $product->aantal }}">
                    </div>

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
                            <a
                                href="{{ route('welcome') }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg"
                            >
                                home
                            </a>
                        </div>
                </form>
            </div>
        </div>
    </div>    
</x-app-layout>