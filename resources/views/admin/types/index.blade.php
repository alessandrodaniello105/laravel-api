@extends('layouts.admin')

@section('content')

    <h1>Lista Tipi</h1>

    <div class="container my-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-primary" role="alert">
                {{session('success')}}
            </div>
        @endif

        <div class="row">

            {{-- Lista tipi + numero progetti --}}
            <div class="col col-4 float-start">
                <div class="card">
                    <div class="card-body">
                        <table class="table">

                            <thead>
                              <tr>
                                <th scope="col">Nome</th>
                                <th class="text-center" scope="col">Numero progetti</th>
                                <th scope="col">Azioni</th>
                              </tr>
                            </thead>

                            <tbody>

                                @foreach ($types as $type)
                                <tr>
                                    <td>{{$type->name}}</td>
                                    <td class="text-center">{{count($type->typeProjects)}}</td>
                                    <td>

                                        <button id="edit-btn-{{$type->id}}" class="btn btn-warning" onclick="startEdit({{$type->id}})">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>

                                        @include('admin.partials.formDelete', ["route" => route('admin.types.destroy', $type)])

                                    </td>
                                </tr>
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            {{-- Colonna crea/edit tipo --}}
            <div class="col-3 float-start">

                {{-- Card creazione --}}
                <div class="card">
                    <div class="card-body">

                        <h3>Crea un nuovo tipo</h3>

                        <form id="create-form" action="{{ route('admin.types.store') }}" method="POST">
                            @csrf

                            <div class="input-group">

                                <input
                                  type="text"
                                  class="form-control @error('name') is-invalid @enderror"
                                  placeholder="Nome nuovo tipo"
                                  id="new-type-input"
                                  name="name"

                                >


                                <button onclick="sendCreate()" class="btn btn-warning rounded-end">Invia</button>

                                @error('name')
                                <ul>

                                    @foreach ($errors->get('name') as $message)
                                        <li class="text-danger-ctm">{{ $message }}</li>
                                    @endforeach

                                </ul>
                                @enderror

                            </div>


                            <div class="form-floating my-2 d-block">
                                <textarea
                                class="form-control @error('description') is-invalid @enderror"
                                id="description"
                                name="description"
                                style="height: 100px"
                                placeholder="Descrizione del progetto"
                                >@if (Route::currentRouteName() == 'admin.types.create') {{old('description')}} @endif</textarea>

                                <label for="description">Descrizione del progetto</label>

                                @error('description')
                                    <ul class="text-danger mt-1">
                                        <li class="text-danger-ctm">{{ $message }}</li>
                                    </ul>
                                @enderror

                            </div>

                        </form>


                    </div>

                </div>
                {{-- /Card creazione --}}

                {{-- Card modifica --}}

                @foreach ($types as $type)
                <div id="edit-form-{{$type->id}}" class="card my-3 edit-form-ctm d-none">
                    <div class="card-body">

                        <h3>Edita un tipo</h3>

                        <form id="form-{{$type->id}}" action="{{ route('admin.types.update', $type) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="input-group mb-3">

                                <input type="hidden" class="form-control" placeholder="Nuovo nome tipo"  name="name" value="{{$type->name}}">
                                <input type="text" class="form-control" placeholder="Nuovo nome tipo"  name="name" value="{{$type->name}}">

                                <button onclick="sendEditForm({{$type->id}})" id="edit-form-btn-{{$type->id}}" class="btn btn-warning">Invia</button>

                            </div>

                            <div class="form-floating my-2 d-block">
                                <textarea
                                class="form-control @error('description') is-invalid @enderror"
                                id="description"
                                name="description"
                                style="height: 100px"
                                placeholder="Descrizione del progetto"
                                >{{old('description', $type?->description)}}</textarea>

                                <label for="description">Descrizione del progetto</label>

                                @error('description')
                                    <ul class="text-danger mt-1">
                                        <li class="text-danger-ctm">{{ $message }}</li>
                                    </ul>
                                @enderror

                            </div>

                        </form>

                    </div>
                </div>
                @endforeach

                {{-- /Card modifica --}}

            </div>

        </div>

    </div>

    <script>

        document.addEventListener(

        //TODO:
        //1. un unico form che ha 2 campi
        // 1 è hidden (name="type_id")
        // l'altro è text (name="name")
        // hanno id univoci
        // al click del bottone 'edit' tolgo il d-none al form con d-none
        //alla funzione arriva (type_id)
        //
        )


        // document.addEventListener('click', function(id){
        //     const editForm = document.getElementById('edit-form-' + id);
        //     console.log(this);
        // })

        function startEdit(id) {

            editForms = document.getElementsByClassName('edit-form-ctm');

            const editForm = document.getElementById('edit-form-'+id);


            for(let i = 0; i < editForms.length; i++) {

                editForms[i].classList.add('d-none');

            }


            editForm.classList.remove('d-none');

        }


        function sendEditForm(id) {

                const form = document.getElementById('form-' + id);
                form.submit();

        }

        function sendCreate() {

                const form = document.getElementById('create-form');
                form.submit();

        }

    </script>

@endsection


@section('title')
Lista tipi
@endsection
