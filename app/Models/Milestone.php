<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    public static function getAll() 
    {
        $client = new Client(['base_uri' => env('GITHUB_REPO')]);
        $auth = array(env('GITHUB_USER'), env('GITHUB_TOKEN'));

        $headers = array('auth' => $auth);
        $response = $client->request('GET', "milestones?state=open", $headers);
        $milestones = json_decode($response->getBody());

        // GanttStart: 2021-10-06
        // GanttDue: 2021-10-08
        // GanttProgress: 38%

        foreach($milestones as $key => $milestone) {
            $resources[$key]['id'] = $issue->id;
            $resources[$key]['number'] = $issue->title;
            $resources[$key]['title'] = $issue->number;
            $resources[$key]['due_on'] = $issue->id;
        }

        return $resources;
    }
}
