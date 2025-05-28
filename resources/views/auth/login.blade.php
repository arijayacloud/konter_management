<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid bg-light h-[100dvh] position-relative">
      <div class="w-75 h-75 bg-white position-absolute top-50 start-50 translate-middle rounded-4 overflow-hidden shadow">
        <div class="row h-100 ">
            <div class="col d-flex align-items-center justify-content-center bg-white">
                <div class="w-sm-75 w-lg-50 h-auto">
                    <div class="text-center mb-4 w-75 mx-auto">
                      <h1 class="fw-bold fs-3 fs-sm-2 fs-md-1">Welcome Back</h1>
                      <p class="text-muted fs-6 fs-sm-6 fs-md-6">Enter your email and password to access your account.</p>
                    </div>

                    <form class="mt-5 w-75 mx-auto">
                      <div class="mb-3">
                        <label for="email" class="form-label fs-6 fs-sm-6 fs-md-5">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                      </div>

                      <div class="mb-3">
                        <label for="password" class="form-label fs-6 fs-sm-6 fs-md-5">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                      </div>

                      <button type="submit" class="btn btn-primary w-100 fs-6 fs-sm-5">Login</button>
                    </form>

                    <div class="mt-3 text-center">
                      <small class="text-muted fs-6">Don't Have An Account? <a href="#">Register</a></small>
                    </div>
                </div>
            </div>
            <div class="d-none col d-md-flex align-items-center justify-content-center">
                <img class="img-fluid" src="{{ asset('images/login.jpg')}}" alt="register">
            </div>
          </div>
      </div>
      <div class="row h-100">
        <div class="col">
        </div>
        <div class="col bg-primary">
        </div>
      </div>
    </div>
</body>
</html>
