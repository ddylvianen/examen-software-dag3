<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-4xl font-bold mb-4 text-green-700 dark:text-green-400">
                        Welkom bij Voedselbank Maaskantje
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                        We helpen gezinnen en individuen in onze gemeenschap door voedsel en ondersteuning te bieden.
                    </p>
                    @guest
                        <div class="flex gap-4">
                            <a href="{{ route('login') }}" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-md transition">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition">
                                {{ __('Register') }}
                            </a>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- About Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4 text-green-700 dark:text-green-400">
                        Wat wij doen
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Onze voedselbank werkt samen met donateurs en vrijwilligers om voeding aan te bieden aan mensen in nood. 
                        We bieden niet alleen voedsel, maar ook begeleiding en ondersteuning.
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                        <li>Voedsel distributie aan gezinnen met financiële moeilijkheden</li>
                        <li>Begeleiding en advisering</li>
                        <li>Samenwerking met lokale organisaties</li>
                        <li>Vrijwilligerswerk mogelijkheden</li>
                    </ul>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-gradient-to-r from-green-700 to-green-600 dark:from-green-800 dark:to-green-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h2 class="text-2xl font-bold mb-4">
                        Wil je ons helpen?
                    </h2>
                    <p class="mb-6">
                        We zoeken altijd vrijwilligers die ons willen ondersteunen in ons werk. Sluit je aan en maak een verschil!
                    </p>
                    <a href="#" class="inline-block bg-white text-green-700 px-6 py-2 rounded-md font-semibold hover:bg-gray-100 transition">
                        Meer informatie
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
