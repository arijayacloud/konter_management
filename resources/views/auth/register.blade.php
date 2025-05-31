<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid bg-light h-[100dvh] position-relative">
      <div class="w-75 h-75 bg-white position-absolute top-50 start-50 translate-middle rounded-4 overflow-hidden shadow">
        <div class="row h-100 ">
            <div class="d-none col d-md-flex align-items-center justify-content-center">
                <img class="img-fluid" src="{{ asset('images/register.jpg')}}" alt="register">
            </div>
            <div class="col d-flex align-items-center h-100 justify-content-center bg-white">
                <div class="w-75 p-lg-5 h-auto">
                    <div class="text-center mb-4">
                      <h1 class="fw-bold fs-4 fs-sm-3 fs-md-2">Create Your Account</h1>
                      <p class="text-muted fs-6 fs-sm-6 fs-md-5">Please fill in the form to register</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="mt-5">
                      @csrf
                      <div class="mb-3">
                        <label for="name" class="form-label fs-6 fs-sm-6 fs-md-5">Nama Konter</label>
                        <input type="text" name="nama_konter" class="form-control" id="name" placeholder="Enter Konter Name" required>
                      </div>

                      <div class="mb-3">
                        <label for="lokasi" class="form-label fs-6 fs-sm-6 fs-md-5">Alamat</label>
                        <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Enter Location" required>
                      </div>

                      <div class="mb-3">
                        <label for="email" class="form-label fs-6 fs-sm-6 fs-md-5">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                      </div>

                      <div class="mb-3">
                        <label for="password" class="form-label fs-6 fs-sm-6 fs-md-5">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                      </div>


                      <button type="submit" class="btn btn-primary w-100 fs-6 fs-sm-5">Register</button>
                    </form>
                    @if ($errors->any())
                        <div class="w-full mt-3">
                                @foreach ($errors->all() as $err)
                                    <div class="alert alert-danger" role="alert">{{ $err }}</div>
                                @endforeach
                        </div>
                    @endif
                    <div class="mt-3 text-center">
                      <small class="text-muted fs-6">Already have an account? <a href="/login">Login</a></small>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="row h-100">
        <div class="col bg-primary">
        </div>
        <div class="col">
        </div>
      </div>
    </div>
</body>
</html>
