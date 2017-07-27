@extends('layouts.app')

@section('title')
    Index/project
@endsection

@section('content')
    <br>
    <div class="col-sm-offset-4 col-sm-4">
        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
        @endif
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des projets</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{!! $project->id !!}</td>
                            <td class="text-primary"><strong>{!! $project->title !!}</strong></td>
                            <td>{!! link_to_route('project.show', 'Voir', [$project->id], ['class' => 'btn btn-success btn-block']) !!}</td>
                            <td>{!! link_to_route('project.edit', 'Modifier', [$project->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
                            <td>

                                {!! Form::open(['method' => 'DELETE', 'route' => ['project.destroy', $project->id]]) !!}

                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce projet ?\')']) !!}

                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {!! link_to_route('project.create', 'Ajouter un projet', [], ['class' => 'btn btn-info pull-right']) !!}

        {!! $links !!}
    </div>
@endsection