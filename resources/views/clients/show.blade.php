<x-layout>
    <x-slot:heading>
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <a href="/clients"class="inline-flex items-center px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18">
                </path>
            </svg>
        </a>
        Client Information
            </div>
        <div>

                <form action="/clients/{{$client['id']}}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 text-sm font-bold">Delete Client</button>
                </form>

            <a href="/clients/{{$client['id']}}/edit" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">Edit Client</a>
        </div>


    </div>
    </x-slot:heading>

    <div class="p-6 bg-white shadow-md rounded-lg block">
        <h2><strong>Name:</strong> {{ $client['name'] }}</h2>
        <h2><strong>Email:</strong> {{ $client['email'] }}</h2>
        <h2><strong>Contact Number:</strong> {{ $client['phone'] ?? 'N/A' }}</h2>
        <h2><strong>Address:</strong> {{ $client['address'] ?? 'N/A' }}</h2>

        <h2><strong>Projects:</strong></h2>
        @if (!empty($client['projects']))
            <ul class="flex flex-wrap -mx-2">
                @foreach ($client['projects'] as $project)
                    <li class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4">
                        <a class="text-blue-500 hover:underline" href="/projects/{{$project['project_id']}}"><strong>{{ $project['name'] }}</strong><br></a>
                        Description: {{ $project['description'] ?? 'None' }}<br>
                        {{-- Rate: {{ '$' . number_format($project['rate'], 2) }}/hour<br>
                        Total Hours: {{ $project['total_hours'] }} --}}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No projects assigned.</p>
        @endif

        <h2><strong>Invoices:</strong></h2>
        @if (!empty($client['invoices']))
            <ul class="flex flex-wrap -mx-2">
                @foreach ($client['invoices'] as $invoice)
                    <li class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4">
                        Invoice ID: {{ $invoice['invoice_number'] }}<br>
                        Project: {{ $invoice['project_name'] }}<br>
                        Amount: {{ '$' . number_format($invoice['amount'], 2) }}<br>
                        Status: <span class="{{ $invoice['status'] === 'Paid' ? 'text-green-600' : 'text-red-500' }}">{{ $invoice['status'] }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No invoices issued.</p>
        @endif
    </div>
</x-layout>

