<div>
    <form action="{{ $action }}" method="POST" onsubmit="{{ $onSubmit }}">
        @csrf
        @method($method)
        <div class="flex flex-wrap gap-1 justify-between">
            <div class="mb-4 w-1/3 flex-grow flex-shrink-0">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" id="name" name="name" required value="{{ $reminder->name ?? '' }}"
                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4 w-1/6">
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                <select id="type" name="type" required value="task"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option {{ $reminder->type === 'Task' ? 'selected' : '' }} value="Task">Task</option>
                    <option {{ $reminder->type === 'Event' ? 'selected' : '' }} value="Event">Event</option>
                </select>
            </div>
            <div class="mb-4 w-1/6">
                <label for="priority"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                <select id="priority" name="priority" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option {{ $reminder->priority === 'Low' ? 'selected' : '' }} value="Low">Low</option>
                    <option {{ $reminder->priority === 'Medium' ? 'selected' : '' }} value="Medium">Medium</option>
                    <option {{ $reminder->priority === 'High' ? 'selected' : '' }} value="High">High</option>
                </select>
            </div>
            <div class="mb-4 w-1/6">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select id="status" name="status" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option {{ $reminder->status === 'Pending"' ? 'selected' : '' }} value="Pending">Pending</option>
                    <option {{ $reminder->status === 'In progress' ? 'selected' : '' }} value="In progress">In
                        progress
                    </option>
                    <option {{ $reminder->status === 'Completed"' ? 'selected' : '' }} value="Completed">Completed
                    </option>
                </select>
            </div>
            <div class="mb-4 w-1/3 flex-grow flex-shrink-0">
                <label for="description"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" name="description" required
                          class="w-full h-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">{{$reminder->description ?? ''}}</textarea>
            </div>
            <div class="mb-4 w-1/6 flex-0 items-stretch">
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due
                    Date</label>
                <input type="datetime-local" id="due_date" name="due_date" required value="{{$reminder->due_date}}"
                       class="w-full h-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <!-- Selector de Labels con label-badge -->
            <div class="mt-4 mb-4 w-full">
                <label for="labels" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Labels</label>
                <div class="relative">
                    <button type="button" id="labels-dropdown-{{ $reminder->id }}"
                            class="w-full text-left px-3 py-2 border rounded-md shadow-sm bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            onclick="toggleLabelsMenu({{ $reminder->id }})">
                        Select Labels
                        <span class="float-right">▼</span>
                    </button>
                    <div id="labels-menu-{{ $reminder->id }}"
                         class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border rounded-md shadow-lg hidden">
                        @foreach($labels as $label)
                            <div class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <input {{$reminder->labels->contains($label->id) ? 'checked' : ''}} type="checkbox"
                                       name="labels[]" value="{{ $label->id }}"
                                       id="label-{{ $label->id }}-{{ $reminder->id }}"
                                       class="mr-2" onchange="updateSelectedLabels({{ $reminder->id }})">
                                <label for="label-{{ $label->id }}-{{ $reminder->id }}"
                                       class="text-sm text-gray-700 dark:text-gray-300">
                                    <x-label-badge :label="$label"/>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start gap-2">
            @if($reminder->id === 0)
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm flex items-start justify-center shadow">
                    <x-heroicon-m-document-check class="w-4 h-4 mr-1"/>
                    {{ $submitLabel }}
                </button>
            @else
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-sm flex items-start justify-center shadow">
                    <x-heroicon-m-check-circle class="w-4 h-4 mr-1"/>
                    Save
                </button>
            @endif
            <button type="button" @click="{{ $onCancel }}"
                    class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded text-sm flex items-start justify-center shadow">
                    <x-heroicon-m-x-circle class="w-4 h-4 mr-1"/>
                {{ __('Cancel') }}
            </button>
        </div>
    </form>
</div>
<script>
    function toggleLabelsMenu(reminderId) {
        document.getElementById(`labels-menu-${reminderId}`).classList.toggle('hidden');
    }

    function updateSelectedLabels(reminderId) {
        const selectedLabelsContainer = document.getElementById(`selected-labels-${reminderId}`);
        selectedLabelsContainer.innerHTML = '';

        // Obtener todos los checkboxes seleccionados
        const selectedCheckboxes = document.querySelectorAll(`#labels-menu-${reminderId} input[name="labels[]"]:checked`);

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
