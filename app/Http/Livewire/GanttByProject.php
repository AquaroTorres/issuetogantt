<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use App\Models\Issue;

class GanttByProject extends Component
{
    public $resources = '';
    public $events = '';

    public function getEvents()
    {
        //if (app()->environment('local')) { debug('getevents'); }
        $issues = Issue::getAll();
        $this->resources = json_encode($issues['resources']);
        $this->events = json_encode($issues['events']);
    }

    public function eventDrop($event, $oldEvent)
    {
        Issue::updateEvent($event);
    }

    public function eventResize($event, $oldEvent)
    {
        Issue::updateEvent($event);
    }

    public function mount()
    {
        $this->getEvents();
    }

    public function render()
    {
        return view('livewire.gantt-by-project');
    }
}
