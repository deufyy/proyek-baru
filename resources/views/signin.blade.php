<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Rental PS Store</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <style>
    body { background-color: #0f172a; height: 100vh; display: flex; align-items: center; justify-content: center; }
    .card-login { width: 100%; max-width: 400px; border-radius: 16px; }
  </style>
</head>
<body>

<div class="card card-login border-0 shadow-lg p-4 bg-white">
  <div class="text-center mb-4">
    <div class="p-3 bg-primary text-white d-inline-block rounded-3 mb-2">
      <i class="ti ti-device-gamepad-2 fs-2"></i>
    </div>
    <h4 class="fw-bold">Rental PS Dashboard</h4>
    <p class="text-muted small">Silakan masuk dengan akun pengelola</p>
  </div>

  @if($errors->has('email'))
    <div class="alert alert-danger border-0 small py-2 mb-3">
      <i class="ti ti-alert-circle me-1"></i>{{ $errors->first('email') }}
    </div>
  @endif

  <form action="{{ route('login.process') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label fw-semibold small">Email Address</label>
      <input type="email" name="email" class="form-control" placeholder="admin@rentalps.com" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold small">Password</label>
      <input type="password" name="password" class="form-control" placeholder="••••••••" required>
    </div>

    <button type="submit" class="btn btn-primary w-100 fw-semibold py-2 mt-2">
      Sign In
    </button>
  </form>
</div>

</body>
</html>