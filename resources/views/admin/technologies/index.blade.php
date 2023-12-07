@extends('layouts.admin')

@section('content')

{{-- Alert di errore --}}
@if ($errors->any())

<div class="alert alert-danger">

    <ul>
        @foreach ($errors->all() as $error)

        <li>
            {{$error}}
        </li>

        @endforeach
    </ul>

</div>


@endif

{{-- Alert di successo --}}
@if (session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

@endif



    <h1>Lista Tecnologie</h1>

    <div class="container my-5">

        {{-- INPUT FORM CREAZIONE TECNOLOGIA --}}
        <form action="{{ route('admin.technologies.store') }}" method="POST">
            @csrf

            <div class="input-group mb-3">

                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nome nuova tecnologia" id="new-technology-input" name="name">

                <button type="submit" class="btn btn-warning">Invia</button>

            </div>

            @error('name')
                <ul>
                    <li class="text-danger-ctm">{{$error}}</li>
                </ul>
            @enderror


        </form>
                                {{-- EDIT BUTTON --}}
                                {{-- <a class="btn btn-warning" href="{{route('admin.projects.edit', $project)}}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a> --}}

        {{-- LISTA TECNOLOGIE --}}
        <div class="card techs-wrapper">
            <ul style="list-style: none;" class="d-flex justify-content-around flex-wrap text-center">
                @foreach ($technologies as $technology)
                <li class="rounded my-3 btn-colored">

                    <a style="width: 300px" class="p-4 d-inline-block" href="{{$technology->link}}">
                        {{$technology->name}}
                    </a>

                    <div class="actions-buttons btn-ctm">
                        {{-- EDIT BUTTON --}}
                        <a href="{{route('admin.technologies.edit', $technology)}}" class="btn btn-warning">
                            <i class="fa-solid fa-pencil"></i>
                        </a>

                        {{-- DELETE BUTTON --}}
                        @include('admin.partials.formDelete', ["route" => route('admin.technologies.destroy', $technology)])
                    </div>

                </li>
                @endforeach

            </ul>
        </div>

    </div>


@endsection


@section('title')
Lista tecnologie
@endsection
