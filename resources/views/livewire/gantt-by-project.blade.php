<div>
    <style>
		html, body {
			margin: 0;
			padding: 0;
			font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
			font-size: 14px;
		}
		#calendarByProject {
            overflow:auto;
			margin: 40px auto;
		}
		#calendarByProject .fc-day-sun, 
		#calendarByProject .fc-day-sat,
        {
			background-color: #cccccc;
		}
		.fc-toolbar .fc-toolbar-title:before {
			float: right;
			/* content: ' - {{ session('gh_repos') }}'; */
		}
	</style>
    
    <div id='calendar-container' wire:ignore>
        <div id='calendarByProject'></div>
    </div>
</div>
    @push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function () {
        
            var calendarEl = document.getElementById('calendarByProject');
            
            var calendarByProject = new FullCalendar.Calendar(calendarEl, {
                locale: '{{ env('FULLCALENDAR_LOCALE') }}',
                schedulerLicenseKey: '{{ env('FULLCALENDAR_SERIAL') }}',
                timeZone: 'UTC',
                initialView: 'resourceTimelineMonth',
                //aspectRatio: 2,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title'
                },
                contentHeight: 'auto',
                slotLabelFormat: [
                    { day: 'numeric' }, // top level of text
                    { weekday: 'narrow' } // lower level of text
                ],
                nowIndicator: true,
                editable: true,
                resourceGroupField: 'project',
                    resourceAreaColumns: [
                    {
                        field: 'title',
                        headerContent: '{{ __('messages.project_milestone') }} - {{ __('messages.issue') }}' 
                    },
                    {
                        field: 'assignees',
                        headerContent: '{{ __('messages.assignees') }}'
                    }
                ],
                //resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
                resources: JSON.parse(@this.resources),
                //events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
                events: JSON.parse(@this.events),

                eventResize: info => @this.eventResize(info.event, info.oldEvent),
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent)
            });

            calendarByProject.render();

        });
    </script>
    @endpush
</div>