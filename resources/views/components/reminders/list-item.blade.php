<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6" x-data="{ isEditing: false }">
    <template x-if="!isEditing">
       <x-reminders.single-item :reminder="$reminder" :labels="$labels"/>
    </template>
    <template x-if="isEditing">
        <x-reminders.form
            :action="route('reminders.update', $reminder->id)"
            :method="'PUT'"
            :on-submit="'isEditing = false'"
            :on-cancel="'isEditing = false'"
            :submit-label="__('Update')"
            :reminder="$reminder"
            :labels="$labels"
        />
    </template>
    <div class="flex justify-end gap-2">
        <button @click="isEditing = true" x-show="!isEditing"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm flex items-center justify-center shadow">
            <x-heroicon-s-pencil-square class="w-4 h-4 mr-1"/>
            Edit
        </button>
        <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" x-show="!isEditing"
              class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded text-sm flex items-center justify-center shadow">
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

        const selectedCheckboxes = document.querySelectorAll(`#labels-edit-menu-${reminderId} input[name="labels[]"]:checked`);

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
