<x-layout>
    <x-slot:heading>
        <div class="sm:flex sm:items-center sm:justify-between">
        Invoice List
        <a href="/invoices/create" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">Add Invoice</a>
    </div>
    </x-slot:heading>

    <div class="flex flex-wrap -mx-2 space-y-4 ">
        @foreach ($invoices as $invoice)
            <div class=" w-full sm:w-1/2 md:w-1/3 mb-4 block py-6 border bg-white border-gray-200 rounded-lg text-center space-y-4">

                <a href="/invoices/{{ $invoice['id']}}" class="text-blue-500 hover:underline">
                <strong>Invoice ID: </strong>{{$invoice['invoice_number']}}
                </a></br>

                <a href="/clients/{{ $invoice['client_id']}}" class="text-blue-500 hover:underline">
                <strong>Client: </strong>{{$invoice['client']['name']}}
                </a></br>


                <a href="/projects/{{ $invoice['project_id']}}" class="text-blue-500 hover:underline">
                <strong>Project: </strong>{{$invoice['project']['name']}}
                </a> </br>

            <strong>Amount: </strong>{{$invoice['amount']}}</br>
            <strong>Status: </strong>
                <span class="{{$invoice['status'] === 'Paid' ? 'text-green-600' : 'text-red-500'}}">{{$invoice['status']}}</span>
            </div>
        @endforeach
    </div>
</x-layout>
