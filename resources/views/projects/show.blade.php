<x-layout>
    <x-slot:heading>
        Projects Information
    </x-slot:heading>

    <div class="p-6 bg-white shadow-md rounded-lg block">
        <h2><strong>Project Name:</strong> {{$project['name']}}</h2>
        <h2><strong>Description:</strong> {{$project['description']}}</h2>
        <h2><strong>Rate:</strong> {{$project['rate']}}</h2>
        <h2><strong>Total Hours:</strong> {{$project['total_hours']}}</h2>
        <h2><strong>Total Cost:</strong> {{$project['total_hours'] * $project['rate']}}</h2>
    </div>
</x-layout>

