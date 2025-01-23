<div>
    <form action="{{ $action }}" method="POST" @submit="{{ $onSubmit }}">
        @csrf
        <div class="flex flex-wrap gap-1 justify-between">
            <div class="mb-4 w-1/3 flex-grow flex-shrink-0">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" id="name" name="name" required value="text"
                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4 w-1/6">
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                <select id="type" name="type" required value="task"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="Task">Task</option>
                    <option value="Event">Event</option>
                </select>
            </div>
            <div class="mb-4 w-1/6">
                <label for="priority"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                <select id="priority" name="priority" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <div class="mb-4 w-1/6">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select id="status" name="status" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option selected value="Pending">Pending</option>
                    <option value="In progress">In progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="mb-4 w-1/3 flex-grow flex-shrink-0">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" name="description" required
                          class="w-full h-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">description</textarea>
            </div>
            <div class="mb-4 w-1/6 flex-0 items-stretch">
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                <input type="datetime-local" id="due_date" name="due_date" required value="2025-01-25T10:00"
                       class="w-full h-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <!-- Selector de Labels con label-badge -->
            <div class="mb-4 w-full">
                <label for="labels" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Labels</label>
                <div class="relative">
                    <button type="button" id="labels-dropdown" class="w-full text-left px-3 py-2 border rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            onclick="document.getElementById('labels-menu').classList.toggle('hidden')">
                        Select Labels
                        <span class="float-right">▼</span>
                    </button>
                    <div id="labels-menu" class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border rounded-md shadow-lg hidden">
                        @foreach($labels as $label)
                            <div class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <input type="checkbox" name="labels[]" value="{{ $label->id }}" id="label-{{ $label->id }}"
                                       class="mr-2" onchange="updateSelectedLabels()">
                                <label for="label-{{ $label->id }}" class="text-sm text-gray-700 dark:text-gray-300">
                                    <x-label-badge :label="$label" />
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Contenedor de etiquetas seleccionadas -->
                <div id="selected-labels" class="flex flex-wrap gap-1 mt-2">
                    <!-- Aquí se mostrarán las etiquetas seleccionadas dinámicamente -->
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-2">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ $submitLabel }}
            </button>
            <button type="button" @click="{{ $onCancel }}"
                    class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded">
                {{ __('Cancel') }}
            </button>
        </div>
    </form>
</div>
<script>
    function updateSelectedLabels() {
        const selectedLabelsContainer = document.getElementById('selected-labels');
        selectedLabelsContainer.innerHTML = '';

        // Obtener todos los checkboxes seleccionados
        const selectedCheckboxes = document.querySelectorAll('input[name="labels[]"]:checked');

        // Crear badges para cada etiqueta seleccionada
        selectedCheckboxes.forEach(checkbox => {
            const labelId = checkbox.value;
            const labelName = checkbox.nextElementSibling.querySelector('span').textContent;

            // Crear un badge (basado en el componente label-badge)
            const badge = document.createElement('span');
            badge.className = 'px-1 rounded text-xs';
            badge.style.backgroundColor = checkbox.parentElement.querySelector('span').style.backgroundColor;
            badge.textContent = labelName;

            selectedLabelsContainer.appendChild(badge);
        });
    }
</script>
