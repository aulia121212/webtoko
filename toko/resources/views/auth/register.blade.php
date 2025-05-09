<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Daftar - Admin umXplore</title>

  <!-- Fonts -->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Styles -->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  
  <style>
    .form-control {
      font-size: 0.9rem; /* Mengubah ukuran font input */
    }
    .btn-user {
      font-size: 0.9rem; /* Mengubah ukuran font tombol */
    }
    .card {
      max-width: 800px; /* Mengatur lebar maksimum kartu */
    }
    .centered {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Memusatkan secara vertikal */
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
  margin-top: 30px; /* Sesuaikan jarak dengan card */
}

.logo-container img {
  width: 520px; /* Sesuaikan ukuran logo */
  height: auto;
}

  </style>
</head>

<body class="bg-success">
<div class="logo-container">
  <img src="{{ asset('images/web_admin.png') }}" alt="Logo">
</div>

  <div class="container centered"> 
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Mendaftar Admin UmXplore</h1>
          </div>
          <form action="{{ route('register.save') }}" method="POST" class="user" autocomplete="off">
            @csrf
            
            <div class="form-group">  
              <input name="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" placeholder="Nama Toko" required>
              @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Anda" autocomplete="off" required>
              @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group position-relative">
    <input id="password" name="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" autocomplete="new-password" required>
    <span class="toggle-password" onclick="togglePassword('password')">
        <i class="fas fa-eye"></i>
    </span>
    @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group position-relative">
    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password" required>
    <span class="toggle-password" onclick="togglePassword('password_confirmation')">
        <i class="fas fa-eye"></i>
    </span>
    @error('password_confirmation')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>


            <button type="submit" class="btn btn-success btn-user btn-block">Daftar</button>
          </form>
          
          <hr>
          <div class="text-center">
            <a class="small" href="{{ route('login') }}">Sudah memiliki akun? Masuk!</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  
  <!-- Scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

  <script>
    function togglePassword(inputId) {
        var input = document.getElementById(inputId);
        var icon = input.nextElementSibling.querySelector("i");

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
  </script>
</body>
</html>
