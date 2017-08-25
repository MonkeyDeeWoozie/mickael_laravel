<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Auth;

class ProjectController extends Controller
{
    protected $projectRepository;
    protected $nbrPerPage = 10;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => 'destroy']);

        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projectRepository->getPaginate($this->nbrPerPage);
        // $links = $projects->render();
        $links = "";

        return view('index_project', compact('projects','links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_project');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $project = $this->projectRepository->store($request->all());
        // return redirect('project')->withOk("Le projet " . $project->title . " a été créé.");

        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);
        $project = $this->projectRepository->store($inputs);

        if(isset($inputs['tags']))
        {
            $tagRepository->store($project, $inputs['tags']);
        }

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->getById($id);
        return view('show_project',  compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->getById($id);
        return view('edit_project',  compact('project'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // var_dump($request);
       // die();
        $this->projectRepository->update($id, $request->only('title', 'content'));
        return redirect('project')->withOk("Le projet " . $request->input('title') . " a été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->projectRepository->destroy($id);
        return redirect()->back();
    }

    public function indexTag($tag)
    {
        $projects = $this->projectRepository->getWithUserAndTagsForTagPaginate($tag, $this->nbrPerPage);
        $links = $projects->render();

        return view('index_project', compact('projects', 'links'))
        ->with('info', 'Résultats pour la recherche du mot-clé : ' . $tag);

    }
}
