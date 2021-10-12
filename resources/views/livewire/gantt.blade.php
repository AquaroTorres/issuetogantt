<div>
    <style>
		html, body {
			margin: 0;
			padding: 0;
			font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
			font-size: 14px;
		}
		#calendar {
			max-height: 800px;
			margin: 40px auto;
		}
		#calendar .fc-day-sun, 
		#calendar .fc-day-sat,
		#calendarByUser .fc-day-sun, 
		#calendarByUser .fc-day-sat{
			background-color: #cccccc;
		}
		.fc-toolbar .fc-toolbar-title:before {
			float: right;
			content: ' - {{ env('GITHUB_REPOS') }}';
		}
	</style>
    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
        <div id='calendarByUser'></div>
    </div>
    
    @push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function () {
        
            var calendarEl = document.getElementById('calendar');
            var calendarE2 = document.getElementById('calendarByUser');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                schedulerLicenseKey: '{{ env('SERIAL_FULLCALENDAR') }}',
                timeZone: 'UTC',
                initialView: 'resourceTimelineMonth',
                //aspectRatio: 2,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title'
                },
                nowIndicator: true,
                editable: true,
                resourceAreaColumns: [
                    {
                        group: true,
                        field: 'milestone',
                        headerContent: 'Project - Milestone'
                    },
                    {
                        field: 'title',
                        headerContent: 'Issue'
                    },
                    {
                        field: 'assignees',
                        headerContent: 'Assigees'
                    }
                ],
                //resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
                resources: JSON.parse(@this.resources),
                //events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
                events: JSON.parse(@this.events),

                eventResize: info => @this.eventResize(info.event, info.oldEvent),
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent)
            });

            var calendarByUser = new FullCalendar.Calendar(calendarE2, {
                locale: 'es',
                schedulerLicenseKey: '{{ env('SERIAL_FULLCALENDAR') }}',
                timeZone: 'UTC',
                initialView: 'resourceTimelineMonth',
                aspectRatio: 2,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title'
                },
                nowIndicator: true,
                editable: true,
                resourceAreaColumns: [
                    {
                        group: true,
                        field: 'assignees',
                        headerContent: 'Assignees'
                    },
                    {
                        field: 'title',
                        headerContent: 'Issue'
                    },
                    {
                        field: 'milestone',
                        headerContent: 'Project - Milestone'
                    }
                ],
                //resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
                resources: JSON.parse(@this.resources),
                //events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
                events: JSON.parse(@this.events),

                eventResize: info => @this.eventResize(info.event, info.oldEvent),
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent)
            });
            calendar.render();

            calendarByUser.render();
        });
    </script>
    @endpush
</div>
