<!DOCTYPE html>
<html lang="en">
<head>
  <title>Birdboard</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css" />
</head>
<body>

  <div class="container" style="padding-top: 60px;">
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
      </div>
    </form>
  </div>

</body>
</html>