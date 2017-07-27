@extends('layouts.app')

@section('title')
    Create/project
@endsection

@section('content')

    <div class="col-sm-offset-4 col-sm-4">

        <br>

        <div class="panel panel-primary">   

            <div class="panel-heading">Création d'un projet</div>

            <div class="panel-body"> 

                <div class="col-sm-12">

                    {!! Form::open(['route' => 'project.store', 'class' => 'form-horizontal panel']) !!}   

                    <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">

                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titre']) !!}

                        {!! $errors->first('title', '<small class="help-block">:message</small>') !!}

                    </div>

                    <div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">

                        {!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => 'Contenu']) !!}

                        {!! $errors->first('content', '<small class="help-block">:message</small>') !!}

                    </div>

                    {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}

                    {!! Form::close() !!}

                </div>

            </div>

        </div>

        <a href="javascript:history.back()" class="btn btn-primary">

            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour

        </a>

    </div>

@endsection