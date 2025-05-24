<x-layout>
    <x-slot:heading>
        <div class="sm:flex sm:items-center sm:justify-left">
        <a href="/clients"class="inline-flex items-center px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18">
                </path>
            </svg>
        </a>
        Add New Client

        </div>
    </x-slot:heading>

    <form method="POST" action="/clients">
        @csrf
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-4">
                <x-form-label for='name'>Company / Client Name</x-form-label>
                <x-form-input name='name' id='name' required></x-form-input>
            </div>

            <div class="sm:col-span-4">
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                    <input type="text" name="email" id="email" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" >
                    </div>
                </div>
            </div>

            <div class="sm:col-span-4">
            <label for="phone" class="block text-sm/6 font-medium text-gray-900">Contact Number</label>
            <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                <input type="text" name="phone" id="phone" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" >
                </div>
            </div>
            </div>

            <div class="sm:col-span-4">
            <label for="address" class="block text-sm/6 font-medium text-gray-900">Address</label>
            <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                <input type="text" name="address" id="address" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" >
                </div>
            </div>
            </div>






        </div>
        </div>



    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
        <x-form-button>Save</x-form-button>
    </div>
    </form>



</x-layout>

