@extends('layouts.app')


@section('content')
  @include('admin.projects.forms.upsert', [
    'action' => route('admin.projects.store'),
    'method' => 'POST',
    'project' => null,
  ])
@endsection