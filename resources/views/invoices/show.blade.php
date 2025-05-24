<x-layout>
    <x-slot:heading>
        Invoice Information
    </x-slot:heading>

    <div class="p-6 bg-white shadow-md rounded-lg block">
        <h2><strong>Invoice Number:</strong> {{$invoice['invoice_number']}}</h2>
        <h2><strong>Client Name:</strong> {{$invoice['client']['name']}}</h2>
        <h2><strong>Project Name:</strong> {{$invoice['project']['name']}}</h2>
        <h2><strong>Amount:</strong> {{$invoice['amount']}}</h2>
        @if ($invoice['status'] === 'Paid')
            <h2><strong>Status:</strong> <span class="text-green-600">{{$invoice['status']}}</span></h2>
        @elseif ($invoice['status'] === 'Pending')
            <h2><strong>Status:</strong> <span class="text-yellow-600">{{$invoice['status']}}</span></h2>
        @elseif ($invoice['status'] === 'Overdue')
            <h2><strong>Status:</strong> <span class="text-red-600">{{$invoice['status']}}</span></h2>
        @endif

    </div>
</x-layout>
