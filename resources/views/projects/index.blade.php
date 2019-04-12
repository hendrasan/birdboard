<!DOCTYPE html>
<html lang="en">
<head>
  <title>Document</title>
</head>
<body>
  <h1>Birdboard</h1>
  @forelse ($projects as $project)
    <ul>
      <li>
        <a href="{{ route('projects.show', $project) }}">
          {{ $project->title }}
        </a>
      </li>
    </ul>
  @empty
    <p>No projects yet.</p>
  @endforelse
</body>
</html>