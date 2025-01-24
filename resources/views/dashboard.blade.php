<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">{{ __("Calendar") }}</h3>
                    <!-- Contenedor del calendario -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Define reminders en el navegador -->
    <script>
        window.reminders = @json($events); // Pasa los datos del backend
    </script>

    <!-- Incluye el archivo compilado con Vite -->
    @vite(['resources/js/app.js'])
</x-app-layout>
