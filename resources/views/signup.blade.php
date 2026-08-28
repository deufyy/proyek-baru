<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Signup - InApp Inventory Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon_io/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon_io/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon_io/favicon-16x16.png') }}">

  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
  <div class="card border-0 shadow-sm" style="max-width:420px; width:100%;">
    <div class="card-body p-5">
      
      <!-- Logo (diklik kembali ke Dashboard /) -->
      <div class="text-center mb-4">
        <a href="/" class="d-inline-flex align-items-center text-decoration-none">
          <img src="{{ asset('assets/images/logo-icon.svg') }}" alt="Logo Icon" width="36">
          <span class="fw-bold fs-4 ms-2 text-dark">InApp</span>
        </a>
        <h1 class="card-title mt-4 mb-2 h5 fw-bold">Create your account</h1>
        <p class="text-muted small">Buat akun baru untuk mengakses sistem</p>
      </div>

      <!-- Form Register -->
      <form class="needs-validation" novalidate>
        <div class="mb-3">
          <label for="fullName" class="form-label">Full name</label>
          <input id="fullName" type="text" class="form-control" placeholder="Jane Doe" required autofocus>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input id="email" type="email" class="form-control" placeholder="name@example.com" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input id="password" type="password" class="form-control" placeholder="Create a password" required minlength="6">
        </div>

        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirm password</label>
          <input id="confirmPassword" type="password" class="form-control" placeholder="Repeat password" required>
        </div>

        <div class="mb-4 form-check">
          <input id="terms" class="form-check-input" type="checkbox" required>
          <label class="form-check-label small text-secondary" for="terms">
            I agree to the <a href="#" class="text-decoration-none">terms and privacy</a>
          </label>
        </div>

        <!-- Tombol Submit -->
        <a href="/signin" class="btn btn-primary w-100 py-2 fw-semibold">Sign up</a>
      </form>

      <!-- Link ke Halaman Signin -->
      <div class="text-center mt-4 small text-muted">
        Already have an account? <a href="/signin" class="link-primary fw-semibold text-decoration-none">Sign in</a>
      </div>

    </div>
  </div>
</div>

  <!-- Bootstrap JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>