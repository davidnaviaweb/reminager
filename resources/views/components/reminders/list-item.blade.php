<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6" x-data="{ isEditing: false }">
    <template x-if="!isEditing">
        <div x-data="{ isEditing: false }">
            <div class="flex gap-8 mb-20">
                <div class="w-1/2">
                    <h3 class="flex items-center text-2xl font-semibold text-gray-950 dark:text-gray-50 gap-2 mb-4">
                        <x-reminders.type-badge :type="$reminder->type"/>
                        {{ $reminder->name }}
                    </h3>
                    <h4 class="flex items-center text-lg font-normal text-gray-500 dark:text-gray-400 gap-2 mb-4">
                        <x-heroicon-c-calendar-days class="w-6 h-6 text-gray-700 dark:text-gray-300"/>
                        <span class="text-base font-semibold text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($reminder->due_date)->format('d-m-Y @ H:i') }}
                        </span>
                    </h4>
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $reminder->description ?? 'No description provided.' }}
                    </p>
                </div>
                <div class="flex w-1/2 gap-4 mb-6">
                    <div class="flex flex-col w-1/4 items-center justify-start">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Priority</h4>
                        <x-reminders.priority-badge :priority="$reminder->priority"/>
                    </div>
                    <div class="flex flex-col w-1/4 items-center justify-start">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Status</h4>
                        <x-reminders.status-badge :status="$reminder->status"/>
                    </div>
                    <div class="flex flex-col w-1/2 items-center justify-start">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Labels</h4>
                        <x-reminders.labels-list :labels="$reminder->labels" :justify="'start'"/>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <template x-if="isEditing">
        <x-reminders.form
            :action="route('reminders.update', $reminder->id)"
            :on-submit="'showForm = false'"
            :on-cancel="'showForm = false'"
            :submit-label="__('Update')"
            :reminder="$reminder"
            :labels="$labels"
        />
    </template>

    <div class="flex gap-2">
        <!-- Botón Editar -->
        <button @click="isEditing = true" x-show="!isEditing"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm flex items-start justify-center shadow">
            <x-heroicon-s-pencil-square class="w-4 h-4 mr-1"/>
            Edit
        </button>

        <!-- Botón Cancelar -->
        <button @click="isEditing = false" x-show="isEditing"
                class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded text-sm flex items-start justify-center shadow">
            Cancel
        </button>

        <!-- Botón Guardar -->
        <form action="{{ route('reminders.update', $reminder->id) }}" method="POST" x-show="isEditing"
              class="inline">
            @csrf
            @method('PUT')
            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-sm flex items-start justify-center shadow">
                <x-heroicon-m-check-circle class="w-4 h-4 mr-1"/>
                Save
            </button>
        </form>

        <!-- Botón Eliminar -->
        <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" x-show="!isEditing"
              class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded text-sm flex items-start justify-center shadow">
                <x-heroicon-c-trash class="w-4 h-4 mr-1"/>
                Delete
            </button>
        </form>
    </div>
</div>
<script>
    function updateSelectedLabels(reminderId) {
        const selectedLabelsContainer = document.getElementById(`selected-labels-${reminderId}`);
        selectedLabelsContainer.innerHTML = '';

        // Obtener todos los checkboxes seleccionados
        const selectedCheckboxes = document.querySelectorAll(`#labels-edit-menu-${reminderId} input[name="labels[]"]:checked`);

        // Crear badges para cada etiqueta seleccionada
        selectedCheckboxes.forEach(checkbox => {
            const labelBadge = checkbox.nextElementSibling.querySelector('span');
            const badge = document.createElement('span');
            badge.className = labelBadge.className;
            badge.style = labelBadge.style.cssText;
            badge.textContent = labelBadge.textContent;

            selectedLabelsContainer.appendChild(badge);
        });
    }
</script>
