<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Issue extends Model
{
    use HasFactory;

    public static function getAll() 
    {
        /* 
        Issue body template:     
        
        GanttStart: 2021-10-06
        GanttDue: 2021-10-08
        GanttProgress: 38% 
        */

        $repos = explode(',',session('gh_repos'));
        $ct = 0; $resources = array(); $events = array();

        foreach($repos as $repo) 
        {
            list($account,$project) = explode('/',$repo);

            $client = new Client(['base_uri' => "https://api.github.com/repos/".$repo."/" ]);
        
            $auth = array(session('gh_user'), session('gh_token'));
            $headers = array('auth' => $auth);
            try {
                $response = $client->request('GET', "issues?state=all", $headers);
            } catch (RequestException $e) {
                echo '<h2>Error: '.__('messages.worng_project'). ' '. $repo . '</h2><br>';
                die($e->getMessage());
            }
            
            $issues = json_decode($response->getBody());
    
            foreach($issues as $key => $issue) {
                /* Issue is not made by a bot or pull request */
                if($issue->user->type != 'Bot' AND !property_exists($issue,'pull_request')) {       
                    $resources[$ct]['milestone'] = 
                        ($issue->milestone) ? 
                        $project .  " - " .  $issue->milestone->title:
                        $project .  " - " ;
                    $resources[$ct]['id'] = $issue->id;
                    $resources[$ct]['title'] =  $issue->title;
                    $events[$ct]['id'] = $issue->number;
                    $events[$ct]['resourceId'] = $issue->id;
                    $events[$ct]['title'] = Issue::getProgress($issue) . '% - #'.$issue->number;
                    $events[$ct]['start'] = Issue::getStart($issue);
                    $events[$ct]['end'] = Issue::getDue($issue);
                    $events[$ct]['repo'] = $repo;
                    if($issue->assignees) {
                        foreach($issue->assignees as $assign) {
                            $resources[$ct]['assignees'] = $assign->login;
                        }
                    }
                    $events[$ct]['color'] = (Issue::getProgress($issue) == 100) ? 'green' : '#4285f4';
                    $ct++;
                }
            }
        }

        return ['events' => $events, 'resources' => $resources];
    }

    public static function getOne($repo,$number)
    {
        $client = new Client(['base_uri' => "https://api.github.com/repos/".$repo."/" ]);
        $auth = array(session('gh_user'), session('gh_token'));
        $headers = array('auth' => $auth);
        $response = $client->request('GET', "issues/$number", $headers);
        return json_decode($response->getBody());
    }

    public static function updateEvent($event)
    {
        $repo = $event['extendedProps']['repo'];
        $issue = Issue::getOne($repo,$event['id']);
        
        $patron = '/GanttStart: (?P<value>\d{4}-\d{2}-\d{2})/';
        $sustitucion = 'GanttStart: '.$event['start'];
        $issue->body = preg_replace($patron, $sustitucion, $issue->body);

        $patron = '/GanttDue: (?P<value>\d{4}-\d{2}-\d{2})/';
        $sustitucion = 'GanttDue: '.$event['end'];
        $issue->body = preg_replace($patron, $sustitucion, $issue->body);

        $client = new Client(['base_uri' => "https://api.github.com/repos/".$repo."/" ]);
        $auth = array(session('gh_user'), session('gh_token'));

        $headers = array(
            'auth' => $auth,
            'Accept' => 'application/vnd.github.v3+json',
            'body' => json_encode(['body' => $issue->body])
        );

        $response = $client->request('PATCH',"issues/$issue->number",$headers);
    }

    public static function getStart($issue) {
        preg_match_all('/GanttStart: (?P<value>\d{4}-\d{2}-\d{2})/', $issue->body, $result);
        return ($result['value']) ? $result['value'][0] : null;
    }
    public static function getDue($issue) {
        preg_match_all('/GanttDue: (?P<value>\d{4}-\d{2}-\d{2})/', $issue->body, $result);
        return ($result['value']) ? $result['value'][0] : null;
    }

    public static function getProgress($issue) {
        /* If issue is closed, then 100% of progress */
        if($issue->state == 'closed') return '100';
        else {
            preg_match_all('/GanttProgress: (?P<value>\d+)/', $issue->body, $result);
            return ($result['value']) ? $result['value'][0] : '0';
        }
    }
}
