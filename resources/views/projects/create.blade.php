@extends('layouts.app')

@section('content')
  <h1 class="heading is-1">Create a project</h1>
  <form method="POST" action="{{ route('projects.store') }}">
    @csrf
    <div class="field">
      <label for="title" class="label">Title</label>
      <div class="control">
        <input type="text" class="input" name="title" placeholder="Title">
      </div>
    </div>

    <div class="field">
      <label for="description" class="label">Description</label>
      <div class="control">
        <textarea name="description" class="textarea"></textarea>
      </div>
    </div>

    <div class="field">
      <button type="submit" class="button is-link">Submit</button>
      <a href="{{ route('projects.index') }}">Cancel</a>
    </div>
  </form>
@endsection

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css" /> --}}
