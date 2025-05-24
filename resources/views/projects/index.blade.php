<x-layout>
    <x-slot:heading>
        <div class="sm:flex sm:items-center sm:justify-between">
        Project List
        <a href="/projects/create" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">Add Project</a>

    </div>
    </x-slot:heading>

    <div class="flex flex-wrap -mx-2 space-y-8">
        @foreach ($projects as $project)

            <div class="w-full sm:w-1/2 md:w-1/2 px-2 mb-4">
                <a href="/projects/{{ $project['id']}}" class="block px-4 py-6 border bg-white border-gray-200 rounded-lg">
                <strong>Project: </strong>{{$project['name']}}</br><strong>Description: </strong>{{$project['description']}}
                </a>
            </div>
        @endforeach
    </div>

    {{ $projects->links() }}
</x-layout>

