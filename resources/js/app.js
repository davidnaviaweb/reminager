import './bootstrap';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    // Verifica si window.reminders está definido
    const reminders = window.reminders || [];
    console.log(reminders); // Muestra los datos cargados desde Blade

    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: reminders, // Usa los datos cargados desde Blade
        editable: true, // Permite mover eventos
        selectable: true, // Permite seleccionar fechas
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
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
});
