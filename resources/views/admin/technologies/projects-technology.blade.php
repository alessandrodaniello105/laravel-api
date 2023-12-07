@extends('layouts.admin')

@section('content')

<h2>Lista progetti per: {{$technology->name}}</h2>

<ul>
    @foreach ($technology->projects as $project)
    <li>
        <a href="{{ route('admin.projects.show', $project) }}">
            {{$project->title}}
        </a>
    </li>
    @endforeach
</ul>

@endsection



@section('title')
Lista Progetti per Tecnologia
@endsection
