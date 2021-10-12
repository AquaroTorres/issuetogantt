<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Issue extends Model
{
    use HasFactory;

    public static function getAll() 
    {
        $endpoint="https://api.github.com/repos/cl-ssi/urgency/";
        $client = new Client(['base_uri' => $endpoint]);
        $auth = array(env('GITHUB_USER'), env('GITHUB_TOKEN'));

        $headers = array('auth' => $auth);
        $response = $client->request('GET', "issues?state=open", $headers);
        $issues = json_decode($response->getBody());

        // <!-- GanttStart: 2021-10-06 -->
        // <!-- GanttDue: 2021-10-08 -->
        // <!-- GanttProgress: 38% -->

        foreach($issues as $key => $issue) {
            $resources[$key]['id'] = $issue->id;
            $resources[$key]['title'] = $issue->title;

            $events[$key]['id'] = $issue->number;
            $events[$key]['resourceId'] = $issue->id;
            $events[$key]['title'] = $issue->title . ' ' . $issue->number;
            $events[$key]['start'] = Issue::getStart($issue);
            $events[$key]['end'] = Issue::getDue($issue);

        }
        return ['events' => $events, 'resources' => $resources];
    }

    public static function getOne($number)
    {
        $endpoint="https://api.github.com/repos/cl-ssi/urgency/";
        $client = new Client(['base_uri' => $endpoint]);
        $auth = array(env('GITHUB_USER'), env('GITHUB_TOKEN'));

        $headers = array('auth' => $auth);

        $response = $client->request('GET', "issues/$number", $headers);
        return json_decode($response->getBody());
    }

    public static function getStart($issue) {
        preg_match_all('/GanttStart: (?P<value>\d{4}-\d{2}-\d{2})/', $issue->body, $result);
        return ($result['value']) ? $result['value'][0] : null;
    }
    public static function getDue($issue) {
        preg_match_all('/GanttDue: (?P<value>\d{4}-\d{2}-\d{2})/', $issue->body, $result);
        return ($result['value']) ? $result['value'][0] : null;
    }

    public static function updateEvent($event)
    {
        debug($event);
        $issue = Issue::getOne($event['id']);
        
        $patron = '/GanttStart: (?P<value>\d{4}-\d{2}-\d{2})/';
        $sustitucion = 'GanttStart: '.$event['start'];
        $issue->body = preg_replace($patron, $sustitucion, $issue->body);

        $patron = '/GanttDue: (?P<value>\d{4}-\d{2}-\d{2})/';
        $sustitucion = 'GanttDue: '.$event['end'];
        $issue->body = preg_replace($patron, $sustitucion, $issue->body);

        debug($issue->body);
        
        $endpoint="https://api.github.com/repos/cl-ssi/urgency/";
        $client = new Client(['base_uri' => $endpoint]);
        $auth = array(env('GITHUB_USER'), env('GITHUB_TOKEN'));

        $headers = array(
            'auth' => $auth,
            'Accept' => 'application/vnd.github.v3+json',
            'body' => json_encode(['body' => $issue->body])
        );

        $response = $client->request('PATCH',"issues/$issue->number",$headers);

    }
}
