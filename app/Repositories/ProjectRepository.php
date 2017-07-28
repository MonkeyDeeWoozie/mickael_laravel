<?php

namespace App\Repositories;

use App\Project;

class ProjectRepository extends ResourceRepository
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->model = $project;
    }

    private function save(Project $project, Array $inputs)
    {
        $project->title = $inputs['title'];
        $project->content = $inputs['content'];

        $project->save();
    }

    public function store(Array $inputs)
    {
        $project = new Project;        
        
        $this->save($project, $inputs);

        return $project;
    }

}