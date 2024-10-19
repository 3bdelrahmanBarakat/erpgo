<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectUser;
use App\Models\User;
use AWS\CRT\HTTP\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AsanaProjectController extends Controller
{
    public static string $token = "2/1206237134658753/1206523070023323:0620093d69059b8e9f5e72d8e961251c";
    public static string $baseUrl = "https://app.asana.com/api/1.0";
    public static function getProjectsFromAsana()
    {
        $projects = Http::withToken(self::$token)->get(self::$baseUrl . "/projects?opt_fields=name,permalink_url,completed,completed_at,due_date,created_at,color,followers");
        if ($projects->successful()) {
            return $projects['data'];
        } else {
            throw new Exception("Failed to retrieve projects from Asana.");
        }
    }

    public static function createNewProject($project)
    {
        $newProject = new Project();
        $newProject->gid = $project['gid'];
        $newProject->asana_url = $project['permalink_url'];
        $newProject->color = $project['color'];
        $newProject->completed = $project['completed'];
        $newProject->start_date = $project['created_at'];
        $newProject->end_date = $project['due_date'];
        $newProject->completed_at = $project['completed_at'];
        $newProject->project_name = $project['name'];
        $newProject->status = $project['completed']?"complete":"in_progress";
        $newProject->project_image = "asana.png";
        $newProject->created_by = 2;
        $newProject->budget = 0;
        $newProject->save();
        self::MakeCompanyShowProjects($newProject->id);
        $projectFollowers = $project['followers'];
        foreach ($projectFollowers as $follower){
            $user = User::query()->where('gid',$follower['gid'])->first();
            if ($user){
                $newProjectUser = new ProjectUser();
                $newProjectUser->project_id = $newProject->id;
                $newProjectUser->user_id = $user->id;
                $newProjectUser->save();
            }
        }
    }
    public static function updateProject(){

    }
    public static function syncProjects()
    {
        $projects = self::getProjectsFromAsana();
        foreach ($projects as $project) {
            $existingProject = Project::where('gid', $project['gid'])->first();
            if (!$existingProject) {
                self::createNewProject($project);
            }
        }
    }
    public static function checkProjectSync()
    {   $projects = Http::withToken(self::$token)->get(self::$baseUrl . "/projects?opt_fields=name,permalink_url,completed,completed_at,due_date,created_at,color,followers");
        $projectData = $projects['data'];
        $lastProject = end($projectData);
        $storedProject =  Project::query()->where('gid',$lastProject['gid'])->first();
        if ($storedProject){
            return true;
         }
         return false;
    }

    private static function MakeCompanyShowProjects($id)
    {
        $newProjectUser = new ProjectUser();
        $newProjectUser->project_id = $id;
        $newProjectUser->user_id = 2;
        $newProjectUser->save();
    }
    public static function createProject($request)
    {
        $user = User::query()->find($request->user[0]);
        $response = Http::withToken(self::$token)
            ->post(self::$baseUrl . "/projects", [
                'data' => [
                    'name' => $request->project_name,
                    'team' => '277108298066353',
                    'workspace' => '275925435424183',
                    'followers' => "1205184575016204,$user->gid",
                    'due_on' => $request->end_date,
                    'public' => true,
                    'default_view' => 'board',
                    'color' => 'dark-green',
                    'owner' => '1205184575016204'
                ],
            ]);

        return $response;
    }
    public static function deleteProject()
    {
    }

    public static function inviteProjectMember($request)
    {   $project = Project::query()->find($request->project_id);
        $user = User::query()->find($request->user_id);
        return Http::withToken(self::$token)
            ->post(self::$baseUrl . "/projects/$project->gid/addMembers", [
                'data' => [
                    'members' => [$user->gid]
                ],
            ]);
    }

    public static function removeUserFromProject($id, $user_id)
    {
        $user = User::query()->find($user_id);
        $project = Project::query()->find($id);
        $project->gid;
        return  Http::withToken(self::$token)
            ->post(self::$baseUrl . "/projects/$project->gid/removeMembers", [
                'data' => [
                    'members' => [$user->gid]
                ],
            ]);
    }

}

