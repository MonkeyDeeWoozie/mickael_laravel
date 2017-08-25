<?php

namespace App\Repositories;

use App\Project;
use Auth;

class ProjectRepository extends ResourceRepository
{
    protected $project;

    public function __construct(Project $project)
    {
        // $this->model = $project;
        $this->project = $project;
    }

    public function getPaginate($n)
    {
        return $this->project->with('user', 'tags')
        ->orderBy('projects.created_at', 'asc')
        ->paginate($n)
        ->where("user_id", Auth::id());
    }

    private function save(Project $project, Array $inputs)
    {
        $project->title = $inputs['title'];
        $project->content = $inputs['content'];

        $project->save();
    }

    public function store(Array $inputs)
    {
        // $project = new Project;        
        // $this->save($project, $inputs);
        // return $project;
        $this->project->create($inputs);
    }

    public function destroy($id)
    {
        $this->project->findOrFail($id)->delete();
    }



    private function queryWithUserAndTags()
    {
        return $this->project->with('user', 'tags')
        ->orderBy('projects.created_at', 'desc');      
    }

    public function getWithUserAndTagsPaginate($n)
    {
        return $this->queryWithUserAndTags()->paginate($n);
    }

    public function getWithUserAndTagsForTagPaginate($tag, $n)
    {
        return $this->queryWithUserAndTags()
        ->whereHas('tags', function($q) use ($tag)
        {
          $q->where('tags.tag_url', $tag);
        })->paginate($n);
    }
}