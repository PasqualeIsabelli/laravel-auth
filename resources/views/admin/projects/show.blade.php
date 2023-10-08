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
        <small class="text-center">{{ $project->creation_date->format('m/d/Y') }}</small>
      </div>
    </div>
    <div class="d-flex gap-3 mt-4">
      <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">Modifica</a>
      <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Elimina</button>
      </form>
    </div>
  </div>
@endsection
