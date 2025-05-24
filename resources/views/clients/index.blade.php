<x-layout>
    <x-slot:heading>
    <div class="sm:flex sm:items-center sm:justify-between">
        Clients
        <a href="/clients/create" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">Add Client</a>

    </div>
    </x-slot:heading>

    <div class="flex flex-wrap -mx-2">
        @forelse ($clients as $client)
        <div class="w-full sm:w-1/2 md:w-1/3 px-2 mb-4">
            <a  href="/clients/{{ $client['id'] }}" class=" block px-4 py-6 border bg-white border-gray-200 rounded-lg">
                <strong>Client: </strong>{{ $client['name'] }} <br>
                <strong>Projects: </strong>
                @if (!empty($client['projects']))
                    {{ implode(', ', $client['projects']) }}
                @else
                    None
                @endif
            </a>
        </div>
        @empty
            <p>No clients found.</p>
        @endforelse
    </div>
</x-layout>

