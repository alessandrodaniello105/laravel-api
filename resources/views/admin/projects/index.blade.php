@extends('layouts.admin')

@section('content')

    <h1>Lista Progetti | <a href="{{route('admin.projects.create')}}"><i class="fa-solid fa-square-plus"></i></a></h1>

    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{session('success')}}
        </div>
    @endif



    <div class="cards-wrapper my-3">
        <div id="cards-wrapper-row" class="row">
                @foreach ($projects as $project)
                <div class="col">
                    <div class="card" style="width: 18rem;">


                        <div class="img-box">

                            {{-- IMAGE --}}
                            <img
                              onerror="this.src = '/img/placeholder.webp'"
                              src="{{asset('storage/' . $project?->image)}}"
                              class="card-img-top"
                              alt="{{ $project?->image_original_name ?? 'placeholder image' }}">

                            <span class="badge bg-secondary">{{$project->type?->name ?? 'Nessun Tipo'}}</span></h6>

                        </div>

                        <div class="card-body">
                            <div class="title-div">
                                <h5 class="card-title">{{ $project->title }}</h5>
                            </div>

                            <hr>

                            <div class="description-div">
                                <p class="card-text">{{ $project->description }}</p>
                            </div>

                            <div class="technologies-div d-flex">
                                @foreach ($project->technologies as $technology)

                                <a href="{{ route('admin.projects-technology', $technology) }}"><span class="badge bg-primary">{{ $technology->name }}</span></a>
                                @endforeach
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <div class="actions align-self-end">

                                {{-- SHOW BUTTON --}}
                                <a class="btn btn-primary" href="{{route('admin.projects.show', $project)}}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- EDIT BUTTON --}}
                                <a class="btn btn-warning" href="{{route('admin.projects.edit', $project)}}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                {{-- DELETE BUTTON --}}
                                @include('admin.partials.formDelete', ["route" => route('admin.projects.destroy', $project)])

                            </div>

                        </div>

                        <div class="card-footer">

                            @if($project->updated_at === $project->created_at)
                                <small class="text-body-secondary">
                                    Project created at {{ $project->created_at }}
                                </small>
                            @else
                                <small class="text-body-secondary">
                                    Last updated at {{ $project->updated_at }}
                                </small>
                            @endif




                        </div>


                      </div>
                </div>
                @endforeach
            </div>
        </div>



@endsection

@section('title')
Lista progetti
@endsection
