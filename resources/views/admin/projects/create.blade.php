@extends('layouts.app')


@section('content')
  <div class="container">
    <form action="{{ route('admin.projects.store') }}" method="POST">
      @csrf()

      <div class="mb-3">
        <label for="title" class="form-label">Titolo:</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Descrizione:</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="thumb" class="form-label">Immagine:</label>
        <input type="text" name="thumb" class="form-control @error('thumb') is-invalid @enderror" value="{{ old('thumb') }}">
        @error('thumb')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="creation_date" class="form-label">Data:</label>
        <input type="text" name="creation_date" class="form-control @error('creation_date') is-invalid @enderror" value="{{ old('creation_date') }}">
        @error('creation_date')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="link" class="form-label">Link:</label>
        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
        @error('link')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="language" class="form-label">Lingua:</label>
        <input type="text" name="language" class="form-control @error('language') is-invalid @enderror" value="{{ old('language') }}">
        @error('language')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-primary">Invia</button>
      </div>
    </form>
  </div>
@endsection