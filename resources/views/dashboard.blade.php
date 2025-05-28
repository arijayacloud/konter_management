<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">MyApp</a>
        <div>
          <button class="btn btn-outline-danger">Logout</button>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
        <h1>Welcome to Dashboard</h1>
        <p>This is a simple dashboard page.</p>
    </div>
</body>
</html>

