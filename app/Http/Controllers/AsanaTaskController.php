<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Http;
class AsanaTaskController extends Controller
{
    public static string $token = "2/1206237134658753/1206523070023323:0620093d69059b8e9f5e72d8e961251c";
    public static string $baseUrl = "https://app.asana.com/api/1.0";
    public static function syncTasks()
    {
        $projects = Project::query()->get();
        foreach ($projects as $project){
            $tasks =  self::getTasksFromAsanaWithProjectGid($project->gid);
            foreach ($tasks as $task)
                if ($task){
                    self::createNewTask($task,$project->id);
                }
        }

    }
    public static function syncTasksForProject($project){
           $tasks =  self::getTasksFromAsanaWithProjectGid($project->gid);
           foreach ($tasks as $task)
           if ($task){
               self::createNewTask($task,$project->id);
           }

    }
    public static function checkTaskSync($project)
    {
        $currentLastTask = ProjectTask::query()->where('project_id', $project->id)->orderBy('gid', 'desc')->first();
        $lastTask = self::getLastTask($project['gid']);
        if ($currentLastTask){
            return $lastTask['gid'] != $currentLastTask->gid;
        }
        else{
           return true;
        }
    }
    public static function getLastTask($project)
    {
        $lastTask = Http::withToken(self::$token)->get(self::$baseUrl . "/tasks?limit=1&project=$project&opt_fields=name,assignee,completed_at,due_on,created_at,permalink_url");
    if ($lastTask['data']){
        return $lastTask['data'][0];

    }
    }
    public static function getTasksFromAsanaWithProjectGid($project)
    {
        if ($project){
            $tasks = Http::withToken(self::$token)->get(self::$baseUrl . "/tasks?project=$project&opt_fields=name,assignee,completed_at,due_on,created_at,permalink_url");
            $tasksData = $tasks['data'];
            usort($tasksData, function($a, $b) {
                return strcmp($a['gid'], $b['gid']);
            });
            return $tasksData;
        }
    }
    public static function createNewTask($task,$project_id)
    {
        $existingTask = ProjectTask::where('gid', $task['gid'])->first();
        $user = null;
        if ($task['assignee']){
            $user = User::query()->where('gid',$task['assignee']['gid'])->first();
        }
        if (!$existingTask) {
            $newTask = new ProjectTask();
            $newTask->gid = $task['gid'];
            $newTask->name = $task['name'];
            $newTask->description = "This task imported from asana";
            $newTask->start_date = $task['created_at'];
            $newTask->end_date = $task['due_on'];
            $newTask->completed_at = $task['completed_at'];
            $newTask->is_complete = $task['completed_at'] ?: 0 ;
            $newTask->priority = "low";
            $newTask->assign_to = optional($user)->id;
            $newTask->project_id = $project_id;
            $newTask->stage_id = 1;
            $newTask->save();
//            return "project created";
        }
    }
    public static function createTask($request, $project_id)
    {
        $assign_to_values = explode(',', $request->assign_to);
        $assignee_id = $assign_to_values[0];

        $user = User::query()->find($assignee_id);
        $project = Project::query()->find($project_id);
        $data = [
            'projects' => [$project->gid],
            'name' => $request->name,
            'assignee' => optional($user)->gid,
            'due_on' => $request->end_date,
        ];
        if ($request->description) {
            $data['notes'] = $request->description;
        }
        $response = Http::withToken(self::$token)
            ->post(self::$baseUrl . "/tasks", [
                'data' => $data,
            ]);
        return $response['data'];
    }

    public static function updateTask($request, $task_id)
    {
        $assign_to_values = explode(',', $request->assign_to);
        $assignee_id = $assign_to_values[0];

        $task = ProjectTask::query()->find($task_id);
        $taskGid = $task->gid;
        $user = User::query()->find($assignee_id);
        $data = [
            'name' => $request->name,
            'assignee' => optional($user)->gid,
            'due_on' => $request->end_date,
        ];
        if ($request->description) {
            $data['notes'] = $request->description;
        }
        $response = Http::withToken(self::$token)
            ->put(self::$baseUrl . "/tasks/$taskGid", [
                'data' => $data,
            ]);
        return $response;
    }
    public static function AsanaDestroy($task_id)
    {
        $task = ProjectTask::query()->find($task_id);
        $taskGid = $task->gid;
        $response = Http::withToken(self::$token)
            ->delete(self::$baseUrl . "/tasks/$taskGid");
        return $response;
    }
//    public static function createTask($request, $project_id)
//    {
//        $assign_to_values = explode(',', $request->assign_to);
//        $assignee_id = $assign_to_values[0];
//
//        $user = User::query()->find($assignee_id);
//        $followers = [];
//
//        for ($i = 1; $i < count($assign_to_values); $i++) {
//            $follower_id = $assign_to_values[$i];
//            $follower = User::query()->find($follower_id);
//            if ($follower) {
//                $followers[] = $follower->gid;
//            }
//        }
//
//        $project = Project::query()->find($project_id);
//
//        $response = Http::withToken(self::$token)
//            ->post(self::$baseUrl . "/tasks", [
//                'data' => [
//                    'projects' => [$project->gid],
//                    'name' => $request->name,
//                    'assignee' => optional($user)->gid,
//                    'followers' => $followers,
//                    'due_on' => $request->end_date,
//                    'notes' => $request->description,
//                ],
//            ]);
//
//        return $response;
//    }

}

