import './bootstrap';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    // Verifica si window.reminders está definido
    const reminders = window.reminders || [];
    debugger;
    console.log(reminders); // Muestra los datos cargados desde Blade

    // Inicializa el calendario
    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: reminders, // Usa los datos cargados desde Blade
        editable: true,
        selectable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        eventContent: function (arg) {
            // Renderización personalizada del evento
            const { priority, labels } = arg.event.extendedProps;

            // Crear el badge de prioridad
            const priorityBadge = {
                High: '<div class="flex items-center justify-center border-2 rounded-full text-white font-extrabold w-5 h-5" style="color: #ff4d4d; border-color: #ff4d4d;">!!!</div>',
                Medium: '<div class="flex items-center justify-center border-2 rounded-full text-white font-extrabold w-5 h-5" style="color: #ffcc00; border-color: #ffcc00;">!!</div>',
                Low: '<div class="flex items-center justify-center border-2 rounded-full text-white font-extrabold w-5 h-5" style="color: #5cb85c; border-color: #5cb85c;">!</div>',
            }[priority] || '';

            // Crear los badges de labels
            let labelBadges = '';
            labels.forEach(label => {
                labelBadges += `<span class="px-1 rounded ${label.textClass}" style="background-color: ${label.backgroundColor};">
                    <span class="text-xs">${label.name}</span>
                </span>`;
            });

            // Retornar el HTML del evento
            return {
                html: `<div class="flex flex-col space-y-1">
                        <div class="flex items-center space-x-2">
                            ${priorityBadge}
                            <span>${arg.event.title}</span>
                        </div>
                        <div class="flex flex-wrap gap-1">${labelBadges}</div>
                    </div>`,
            };
        },
        eventClick: function(info) {
            alert(
                'Event: ' +
                info.event.title +
                '\nDescription: ' +
                info.event.extendedProps.description
            );
        }
    });

    calendar.render();

    // Filtrar por Prioridad
    document.getElementById('priorityFilter').addEventListener('change', function (e) {
        const selectedPriority = e.target.value;

        // Filtra eventos según la prioridad seleccionada
        const filteredEvents = selectedPriority
            ? reminders.filter(event => event.priority === selectedPriority)
            : reminders; // Si no hay filtro, muestra todos los eventos

        calendar.removeAllEvents(); // Limpia los eventos actuales
        calendar.addEventSource(filteredEvents); // Añade los eventos filtrados
    });

    // Filtrar por Labels
    document.getElementById('labelFilter').addEventListener('change', function (e) {
        const selectedLabel = e.target.value;

        // Filtra eventos según la etiqueta seleccionada
        const filteredEvents = selectedLabel
            ? reminders.filter(event =>
                event.labels && event.labels.includes(selectedLabel)
            )
            : reminders; // Si no hay filtro, muestra todos los eventos

        calendar.removeAllEvents(); // Limpia los eventos actuales
        calendar.addEventSource(filteredEvents); // Añade los eventos filtrados
    });
});
