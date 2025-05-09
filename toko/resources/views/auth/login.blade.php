<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Masuk - UMKM XPLORE</title>
  <!-- Fonts -->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Styles -->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style>
     .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .form-control {
      font-size: 0.9rem;
    }
    .btn-user {
      font-size: 0.9rem;
    }
    .card {
      max-width: 800px;
    }
    .centered {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .input-group {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
    }
    .toggle-password i {
      font-size: 18px;
    }
    .logo-container {
      display: flex;
      justify-content: center;
      margin-bottom: -60px;
      margin-top: 30px;
    }
    .logo-container img {
      width: 520px;
      height: auto;
    }
  </style>
</head>
<body class="bg-success">
  <div class="logo-container">
    <img src="{{ asset('images/web_admin.png') }}" alt="Logo">
  </div>
  <div class="container">
    <div class="row justify-content-center">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                  </div>
                  <form action="{{ route('login.action') }}" method="POST" class="user">
                    @csrf
                    @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                      </div>
                    @endif
                    <div class="form-group">
                      <input name="email" type="email" class="form-control form-control-user" placeholder="Email Anda..." required>
                    </div>
                    <div class="form-group input-group">
                      <input name="password" id="password" type="password" class="form-control form-control-user" placeholder="Password" required>
                      <span class="toggle-password" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                      </span>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block btn-user">Masuk</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Buat akun baru!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- JavaScript -->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  
  <script>
    function togglePassword(id) {
      var passwordInput = document.getElementById(id);
      var icon = passwordInput.nextElementSibling.querySelector("i");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>
</body>
</html>
