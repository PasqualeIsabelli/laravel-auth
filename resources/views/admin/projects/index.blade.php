@extends('layouts.app')


@section('content')
  <div class="container">
    <div class="row row-cols-6 gap-3 mt-4">
      @foreach ($projects as $project)
        <a class="text-decoration-none" href="{{ route('admin.projects.show', $project->id) }}">
          <div class="card">
            <img src="{{ $project['thumb'] }}" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">{{ $project->title }}</h5>
            </div>
          </div>
        </a>
      @endforeach
    </div>
    <a class="btn btn-primary mt-4" href="{{route('admin.projects.create') }}">Nuovo Progetto</a>
  </div>
@endsection

