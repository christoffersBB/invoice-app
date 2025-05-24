<x-layout>
    <x-slot:heading>
        Project Information
    </x-slot:heading>

    <form method="POST" action="/projects">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Project Profile</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Client -->
                    <div class="sm:col-span-4">
                        <label for="client_id" class="block text-sm/6 font-medium text-gray-900">Client</label>
                        <div class="mt-2 relative">
                            <input type="text" id="client_search" autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6"
                                placeholder="Search clients...">
                            <input type="hidden" name="client_id" id="client_id" value="{{ old('client_id') }}">
                            <div id="client_dropdown" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 hidden">
                                <ul id="client_list" class="max-h-60 overflow-auto py-1 text-sm text-gray-700"></ul>
                            </div>
                            @error('client_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Project Name -->
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Project Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6">
                            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-full">
                        <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea name="description" id="description" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6">{{ old('description') }}</textarea>
                            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the project.</p>
                    </div>

                    <!-- New Rate input -->
<div class="sm:col-span-4">
    <label for="rate" class="block text-sm/6 font-medium text-gray-900">Rate / Hour </label>
    <div class="mt-2">
        <input type="number" step="0.01" name="rate" id="rate" value="{{ old('rate') }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6"
            placeholder="e.g., 100.50">
        @error('rate') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<!-- New Total Hours input -->
<div class="sm:col-span-4">
    <label for="total_hours" class="block text-sm/6 font-medium text-gray-900">Total Hour(s)</label>
    <div class="mt-2">
        <input type="number" step="0.1" name="total_hours" id="total_hours" value="{{ old('total_hours') }}"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6"
            placeholder="e.g., 20.5">
        @error('total_hours') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/projects" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

    <script>
        // Initial data
        const clients = @json($clients);

        // Client Search
        const clientSearch = document.getElementById('client_search');
        const clientDropdown = document.getElementById('client_dropdown');
        const clientList = document.getElementById('client_list');
        const clientIdInput = document.getElementById('client_id');

        clientSearch.addEventListener('input', () => {
            const query = clientSearch.value.toLowerCase();
            clientList.innerHTML = '';
            const filteredClients = clients.filter(client => client.name.toLowerCase().includes(query));

            filteredClients.forEach(client => {
                const li = document.createElement('li');
                li.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
                li.textContent = client.name;
                li.addEventListener('click', () => {
                    clientSearch.value = client.name;
                    clientIdInput.value = client.id;
                    clientDropdown.classList.add('hidden');
                });
                clientList.appendChild(li);
            });

            clientDropdown.classList.toggle('hidden', filteredClients.length === 0);
        });

        // Close dropdown on outside click
        document.addEventListener('click', (event) => {
            if (!clientSearch.contains(event.target) && !clientDropdown.contains(event.target)) {
                clientDropdown.classList.add('hidden');
            }
        });
    </script>
</x-layout>
