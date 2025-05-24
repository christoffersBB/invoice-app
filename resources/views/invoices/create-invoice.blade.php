<x-layout>
    <x-slot:heading>
        Invoice Information
    </x-slot:heading>

    <form action="/invoices" method="POST">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Invoice Information</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Invoice Number -->
                    <div class="sm:col-span-4">
                        <label for="invoice_number" class="block text-sm/6 font-medium text-gray-900">Invoice No.</label>
                        <div class="mt-2">
                            <input type="text" name="invoice_number" id="invoice_number" value="{{ $next_invoice_number }}" readonly
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 bg-gray-100 cursor-not-allowed sm:text-sm/6">
                            @error('invoice_number') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Client -->
                    <div class="sm:col-span-4">
                        <label for="client_id" class="block text-sm/6 font-medium text-gray-900">Client</label>
                        <div class="mt-2 relative">
                            <input type="text" id="client_search" autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6"
                                placeholder="Search clients...">
                            <input type="hidden" name="client_id" id="client_id">
                            <div id="client_dropdown" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 hidden">
                                <ul id="client_list" class="max-h-60 overflow-auto py-1 text-sm text-gray-700"></ul>
                            </div>
                            @error('client_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Project -->
                    <div class="sm:col-span-4">
                        <label for="project_id" class="block text-sm/6 font-medium text-gray-900">Project</label>
                        <div class="mt-2 relative">
                            <input type="text" id="project_search" autocomplete="off" disabled
                                class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6 bg-gray-100 cursor-not-allowed"
                                placeholder="Select a client first...">
                            <input type="hidden" name="project_id" id="project_id">
                            <div id="project_dropdown" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 hidden">
                                <ul id="project_list" class="max-h-60 overflow-auto py-1 text-sm text-gray-700"></ul>
                            </div>
                            @error('project_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Total Hours -->
                    <div class="sm:col-span-4">
                        <label for="total_hours" class="block text-sm/6 font-medium text-gray-900">Total Hours</label>
                        <div class="mt-2">
                            <input type="number" step="0.1" name="total_hours" id="total_hours" readonly
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm/6">
                            @error('total_hours') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Total Amount -->
                    <div class="sm:col-span-4">
                        <label for="amount" class="block text-sm/6 font-medium text-gray-900">Total Amount</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" name="amount" id="amount" readonly
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 bg-gray-100 cursor-not-allowed sm:text-sm/6">
                            @error('amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="sm:col-span-4">
                        <label for="status" class="block text-sm/6 font-medium text-gray-900">Status</label>
                        <div class="mt-2 relative">
                            <button type="button" id="status_button" class="w-full flex justify-between items-center rounded-md bg-white px-3 py-1.5 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 hover:bg-gray-50" aria-expanded="false" aria-haspopup="true">
                                <span id="selected_status">Pending</span>
                                <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="status_menu" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg ring-1 ring-black/5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="status_button">
                                <div class="py-1" role="none">
                                    <button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" data-value="Pending">Pending</button>
                                    <button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" data-value="Paid">Paid</button>
                                    <button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" data-value="Overdue">Overdue</button>
                                </div>
                            </div>
                            <input type="hidden" name="status" id="status" value="Pending">
                            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/invoices" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

    <script>
        // Initial data
        const clients = @json($clients);
        const projects = @json($projects);
        let selectedProjectRate = 0;

        // Client Search
        const clientSearch = document.getElementById('client_search');
        const clientDropdown = document.getElementById('client_dropdown');
        const clientList = document.getElementById('client_list');
        const clientIdInput = document.getElementById('client_id');
        const projectSearch = document.getElementById('project_search');
        const projectDropdown = document.getElementById('project_dropdown');
        const projectList = document.getElementById('project_list');
        const projectIdInput = document.getElementById('project_id');
        const totalHoursInput = document.getElementById('total_hours');
        const amountInput = document.getElementById('amount');

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
                    projectSearch.disabled = false;
                    projectSearch.classList.remove('bg-gray-100', 'cursor-not-allowed');
                    projectSearch.placeholder = 'Search projects...';
                    projectIdInput.value = '';
                    projectSearch.value = '';
                    projectList.innerHTML = '';
                    totalHoursInput.value = '';
                    selectedProjectRate = 0;
                    updateTotalAmount();
                });
                clientList.appendChild(li);
            });

            clientDropdown.classList.toggle('hidden', filteredClients.length === 0);
        });

        // Project Search
        projectSearch.addEventListener('input', () => {
            if (!clientIdInput.value) return;

            const query = projectSearch.value.toLowerCase();
            const filteredProjects = projects.filter(project =>
                project.client_id == clientIdInput.value &&
                project.name.toLowerCase().includes(query)
            );

            projectList.innerHTML = '';
            filteredProjects.forEach(project => {
                const li = document.createElement('li');
                li.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
                li.textContent = project.name;
                li.addEventListener('click', () => {
                    projectSearch.value = project.name;
                    projectIdInput.value = project.id;
                    projectDropdown.classList.add('hidden');
                    selectedProjectRate = project.rate;
                    totalHoursInput.value = project.total_hours;
                    updateTotalAmount();
                });
                projectList.appendChild(li);
            });

            projectDropdown.classList.toggle('hidden', filteredProjects.length === 0);
        });

        // Total Amount Calculation
        function updateTotalAmount() {
            const hours = parseFloat(totalHoursInput.value) || 0;
            const amount = hours * selectedProjectRate;
            amountInput.value = amount.toFixed(2);
        }

        totalHoursInput.addEventListener('input', updateTotalAmount);

        // Status Dropdown
        const statusButton = document.getElementById('status_button');
        const statusMenu = document.getElementById('status_menu');
        const selectedStatus = document.getElementById('selected_status');
        const statusInput = document.getElementById('status');
        const menuItems = statusMenu.querySelectorAll('[role="menuitem"]');

        statusButton.addEventListener('click', () => {
            statusMenu.classList.toggle('hidden');
            statusButton.setAttribute('aria-expanded', !statusMenu.classList.contains('hidden'));
        });

        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                const value = item.getAttribute('data-value');
                selectedStatus.textContent = value;
                statusInput.value = value;
                statusMenu.classList.add('hidden');
                statusButton.setAttribute('aria-expanded', 'false');
            });
        });

        // Close dropdowns on outside click
        document.addEventListener('click', (event) => {
            if (!statusButton.contains(event.target) && !statusMenu.contains(event.target)) {
                statusMenu.classList.add('hidden');
                statusButton.setAttribute('aria-expanded', 'false');
            }
            if (!clientSearch.contains(event.target) && !clientDropdown.contains(event.target)) {
                clientDropdown.classList.add('hidden');
            }
            if (!projectSearch.contains(event.target) && !projectDropdown.contains(event.target)) {
                projectDropdown.classList.add('hidden');
            }
        });
    </script>
</x-layout>
