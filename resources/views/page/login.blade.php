<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang yang lembut */
        }
        .card {
            border-radius: 1rem; /* Membuat sudut kartu melengkung */
        }
        .btn-primary {
            background-color: #435ebe; /* Warna utama tombol */
            border: none;
        }
        .btn-primary:hover {
            background-color: #3a51b0; /* Warna saat hover */
        }
    </style>
  </head>
  <body>
    <section class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="card border-0 shadow-lg p-4">
                        <div class="card-body">
                            <!-- Logo or Icon -->
                            <div class="text-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle " viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                                <h5 class="mt-3">Login</h5>
                            </div>

                            <!-- Error Alert -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">NIP/NUPTK</label>
                                    <input type="text" value="{{ old('username') }}" name="username" id="username" class="form-control" placeholder="Masukkan NIP/NUPTK" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('page.landing') }}" class="btn btn-outline-secondary">
                                        Kembali
                                    </a>
                                    <button class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
