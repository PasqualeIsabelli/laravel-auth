@extends('layouts.app')


@section('content')
  @include('admin.projects.forms.upsert', [
    'action' => route('admin.projects.update', $project->slug),
    'method' => 'PUT',
    'project' => $project,
  ])
@endsection