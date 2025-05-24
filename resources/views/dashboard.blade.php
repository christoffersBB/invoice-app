<x-layout>
    <x-slot:heading>
        Dashboard
    </x-slot:heading>
    <h1><strong>Overview</strong></h1>

    <h2>Total Income: ${{ $total_income }}</h2>
    <h2>Current Month Income: ${{ $current_month_income }}</h2>
    <h2>Total Clients: {{ $client_count }}</h2>
    <h2>Total Projects: {{ $project_count }}</h2>
    <h2>Outstanding Invoices: {{ $outstanding_invoice_count }}</h2>
    <div class="space-y-8">
        <section>
            <h3 class="text-red-500 text-lg font-bold mb-4">Pending/Outstanding</h3>
            <ul class="flex flex-wrap -mx-2">
                @forelse ($jobs as $job)
                    <li class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4">
                        <div class="block px-4 py-6 border bg-white shadow-sm border-gray-200 rounded-lg">
                            <p class="font-semibold"><span class="text-gray-600">Client:</span> {{ $job['client'] }}</p>
                            <p class="font-semibold"><span class="text-gray-600">Project:</span> {{ $job['project'] }}</p>
                            <p class="font-semibold text-red-500"><span class="text-gray-600">Outstanding Invoice:</span> {{ '$' . number_format($job['outstanding_invoice'], 2) }}</p>
                        </div>
                    </li>
                @empty
                    <li class="w-full text-center text-gray-500">No outstanding invoices.</li>
                @endforelse
            </ul>
        </section>

        <section>
            <h3 class="text-green-600 text-lg font-bold mb-4">Completed Jobs</h3>
            <ul class="flex flex-wrap -mx-2">
                @forelse ($completed_jobs as $completed_job)
                    <li class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4">
                        <div class="block px-4 py-6 border bg-white shadow-sm border-gray-200 rounded-lg">
                            <p class="font-semibold"><span class="text-gray-600">Client:</span> {{ $completed_job['client'] }}</p>
                            <p class="font-semibold"><span class="text-gray-600">Project:</span> {{ $completed_job['project'] }}</p>
                            <p class="font-semibold text-green-600"><span class="text-gray-600">Paid Amount:</span> {{ '$' . number_format($completed_job['outstanding_invoice'], 2) }}</p>
                        </div>
                    </li>
                @empty
                    <li class="w-full text-center text-gray-500">No completed jobs.</li>
                @endforelse
            </ul>
        </section>
    </div>
</x-layout>
