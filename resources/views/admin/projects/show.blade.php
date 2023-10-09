@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row row-cols-6 gap-3 mt-4">
      <div class="card border-0">
        <img src="{{ $project['thumb'] }}" class="card-img-top">
      </div>
    </div>
    <div class="mt-3">
      <h5>{{ $project->title }}</h5>
      <p>{{ $project->description }}</p>
      <p class="card-text">{{ 'language', implode(',', $project->language) }}</p>
      <div class="d-flex justify-content-between">
        <a href="{{ $project->link }}" class="text-decoration-none">Link</a>
        <small class="text-center">{{ $project->creation_date->format('d/m/Y') }}</small>
      </div>
    </div>
    <div class="d-flex gap-1 mt-4">
      <div>
        <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-warning">Modifica</a>
        <a class="btn btn-secondary" href="{{ route("admin.projects.index") }}">Indietro</a>
      </div>
      <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Elimina</button>
      </form>
    </div>
  </div>
@endsection