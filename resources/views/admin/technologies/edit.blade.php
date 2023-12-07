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


    <h1>{{ $title }}</h1>

    <form
      action="{{ $route }}"
      method="POST"
      enctype="multipart/form-data">

        @csrf
        @method( $method )


        <div class="container p-3">

        {{-- TITOLO --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nome Tecnologia</label>
            <input
              type="text"
              class="form-control @error('name') is-invalid @enderror"
              placeholder="Beautiful Tech"
              name="name"
              value="{{old('title', $technology?->name )}}">

            @error('name')
                <ul class="text-danger mt-1">
                    <li><p class="">{{$message}}</p></li>
                </ul>
            @enderror

        </div>


        {{-- LINK --}}
        <div class="mb-3">

            <label for="link" class="form-label">Inserisci il link di riferimento per la tecnologia</label>

           <input
              type="text"
              class="form-control @error('link') is-invalid @enderror"
              placeholder="https://..."
              name="link"
              value="{{old('link', $technology?->link)}}">

            @error('link')
                <ul class="text-danger mt-1">
                    <li><p class="">{{$message}}</p></li>
                </ul>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">Invia</button>
        <button type="reset" class="btn btn-danger">Pulisci i campi</button>

        <a class="btn btn-secondary" href="{{ route('admin.technologies.index') }}">Annulla</a>

    </form>

@endsection

@section('title')
Modifica
@endsection
