<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-green-700 dark:text-green-400 underline underline-offset-4 text-center">
                        Wijzig voedselpakket status
                    </h1>

                    @php
                        $redirectTo = session('redirectTo');
                    @endphp

                    @if ($successMessage)
                        <div class="mt-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                            {{ $successMessage }}
                        </div>

                        @if ($redirectTo)
                            <script>
                                setTimeout(function () {
                                    window.location.href = @json($redirectTo);
                                }, 3000);
                            </script>
                        @endif
                    @endif

                    @if ($errorMessage)
                        <div class="mt-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            {{ $errorMessage }}
                        </div>
                    @endif

                    @if ($voedselpakket)
                        <form method="POST" action="{{ route('voedselpakketten.pakketten.update', ['voedselpakketId' => $voedselpakket->VoedselpakketId]) }}" class="mt-6">
                            @csrf
                            @method('PATCH')

                            <div class="flex justify-center">
                                <select
                                    name="status"
                                    class="w-full max-w-xl border border-gray-300 rounded-md px-3 py-2 bg-white dark:bg-gray-900 dark:border-gray-700"
                                    @disabled($isLocked)
                                >
                                    @php
                                        $current = $voedselpakket->Status;
                                        $options = [
                                            'NietUitgereikt' => 'Niet Uitgereikt',
                                            'Uitgereikt' => 'Uitgereikt',
                                        ];
                                    @endphp

                                    @foreach ($options as $value => $label)
                                        <option value="{{ $value }}" @selected($current === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-6 flex items-center justify-between">
                                <button
                                    type="submit"
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md"
                                    @disabled($isLocked)
                                >
                                    Wijzig status voedselpakket
                                </button>

                                <div class="flex gap-3">
                                    <a href="{{ $backUrl }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                        terug
                                    </a>
                                    <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                        home
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

