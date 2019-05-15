@extends('layouts.app')

@section('content')
  <div class="flex items-center mb-4">
    <h1 class="mr-auto">Birdboard</h1>

    <a href="{{ route('projects.create') }}">Create New Project</a>
  </div>

  <div class="flex flex-wrap">
    @forelse ($projects as $project)
      <div class="w-full sm:w-1/2 md:w-1/3 bg-white mb-4 mr-4 rounded shadow p-5" style="height: 200px;">
        <h3 class="font-normal text-xl py-4">{{ $project->title }}</h3>

        <div class="text-grey">{{ str_limit($project->description, 100) }}</div>
      </div>
    @empty
      <p>No projects yet.</p>
    @endforelse
  </div>
@endsection