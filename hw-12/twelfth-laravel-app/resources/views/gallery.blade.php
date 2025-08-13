<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gallery') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Галерея: 4 картинки в ряд -->
                <div class="p-6 flex flex-row flex-nowrap space-x-6 justify-center">
                    <img src="{{ asset('images/favicon-200x200.png') }}"
                         alt="Picture 1"
                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">

                    <img src="{{ asset('images/favicon-200x200.png') }}"
                         alt="Picture 2"
                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">

                    <img src="{{ asset('images/favicon-200x200.png') }}"
                         alt="Picture 3"
                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">

                    <img src="{{ asset('images/favicon-200x200.png') }}"
                         alt="Picture 4"
                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">

                    <img src="{{ asset('images/favicon-200x200.png') }}"
                         alt="Picture 4"
                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">
                </div>

            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Галерея -->
                <div class="p-6 grid grid-cols-4 gap-6 justify-items-center">
                    <img src="{{ asset('images/favicon-new.png') }}"
                         alt="Picture 1"
                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">

{{--                    <img src="{{ asset('images/favicon-new.png') }}"--}}
{{--                         alt="Picture 2"--}}
{{--                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">--}}

{{--                    <img src="{{ asset('images/favicon-new.png') }}"--}}
{{--                         alt="Picture 3"--}}
{{--                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">--}}

{{--                    <img src="{{ asset('images/favicon-new.png') }}"--}}
{{--                         alt="Picture 4"--}}
{{--                         class="w-[200px] h-[200px] object-cover rounded-lg shadow-md">--}}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
