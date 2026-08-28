<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Unit - Rental PS Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

  <style>
    :root {
      --bg-body: #f4f6f9;
      --bg-card: #ffffff;
      --text-color: #1e293b;
      --text-muted: #64748b;
      --border-color: #e2e8f0;
      --topbar-bg: #ffffff;
    }

    [data-bs-theme="dark"] {
      --bg-body: #0b1329;
      --bg-card: #1e293b;
      --text-color: #f8fafc;
      --text-muted: #94a3b8;
      --border-color: #334155;
      --topbar-bg: #0f172a;
    }

    body { 
      background-color: var(--bg-body); 
      color: var(--text-color);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      transition: background-color 0.3s, color 0.3s;
    }
    
    .sidebar { 
      width: 260px; 
      position: fixed; 
      top: 0; 
      left: 0; 
      height: 100vh; 
      background: #0f172a; 
      z-index: 1000; 
      padding: 24px 16px; 
      box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }

    .sidebar .logo-area { 
      padding: 0 12px 24px; 
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      margin-bottom: 20px;
    }

    .sidebar .nav-link {
      color: #94a3b8 !important;
      font-weight: 500;
      padding: 10px 16px;
      border-radius: 10px;
      margin-bottom: 4px;
      display: flex;
      align-items: center;
      transition: all 0.2s ease-in-out;
    }

    .sidebar .nav-link i {
      font-size: 18px;
      transition: transform 0.2s ease;
    }

    .sidebar .nav-link:hover {
      color: #ffffff !important;
      background-color: rgba(255, 255, 255, 0.06);
      transform: translateX(4px);
    }

    .sidebar .nav-link:hover i {
      transform: scale(1.1);
    }

    .sidebar .nav-link.active {
      color: #ffffff !important;
      background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%) !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
      font-weight: 600;
    }

    .sidebar .nav-item small {
      color: #475569 !important;
      letter-spacing: 0.08em;
      font-size: 11px;
    }

    .topbar { 
      margin-left: 260px; 
      width: calc(100% - 260px); 
      z-index: 999; 
      background-color: var(--topbar-bg) !important;
      border-bottom-color: var(--border-color) !important;
      transition: background-color 0.3s;
    }

    .content { 
      margin-left: 260px; 
      padding-top: 80px !important; 
    }

    .card {
      background-color: var(--bg-card);
      border-color: var(--border-color);
      color: var(--text-color);
      transition: background-color 0.3s, border-color 0.3s;
    }

    .text-muted { color: var(--text-muted) !important; }

    [data-bs-theme="dark"] .form-control, 
    [data-bs-theme="dark"] .form-select { 
      background-color: #0f172a; 
      color: #fff; 
      border-color: #334155; 
    }

    @media (max-width: 991.98px) { 
      .sidebar { display: none; } 
      .topbar, .content { margin-left: 0; width: 100%; } 
    }
  </style>
</head>
<body>

  <!-- TOPBAR -->
  <nav id="topbar" class="navbar border-bottom fixed-top topbar px-3">
    <div class="ms-auto d-flex align-items-center gap-3">
      <button class="btn btn-light btn-icon rounded-circle" id="themeToggleBtn" onclick="toggleDarkMode()">
        <i class="ti ti-moon fs-5" id="themeIcon"></i>
      </button>

      <div class="dropdown">
        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="" class="rounded-circle" width="36" height="36">
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
          <li><a class="dropdown-item text-danger" href="/logout"><i class="ti ti-logout me-2"></i>Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- SIDEBAR MODERN DARK -->
  <aside id="sidebar" class="sidebar">
    <div class="logo-area">
      <a href="/dashboard" class="d-inline-flex align-items-center text-decoration-none">
        <div class="p-2 rounded-3 bg-primary bg-gradient text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
          <i class="ti ti-device-gamepad-2 fs-4"></i>
        </div>
        <span class="fw-bold fs-5 ms-2 text-white">Rental PS</span>
      </a>
    </div>

    <ul class="nav flex-column">
      <li class="nav-item mb-2 ps-2"><small class="fw-bold">MAIN MENU</small></li>
      
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <i class="ti ti-smart-home me-3"></i>Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/inventory">
          <i class="ti ti-device-gamepad me-3"></i>Daftar Unit PS
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/create-product">
          <i class="ti ti-plus me-3"></i>Tambah Unit
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/create-transaction">
          <i class="ti ti-shopping-cart-plus me-3"></i>Sewa Baru
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/reports">
          <i class="ti ti-receipt me-3"></i>Laporan Rental
        </a>
      </li>

      <li class="nav-item mt-4 mb-2 ps-2"><small class="fw-bold">ACCOUNT</small></li>
      
      <li class="nav-item">
        <a class="nav-link text-danger" href="/logout">
          <i class="ti ti-logout me-3"></i>Logout
        </a>
      </li>
    </ul>
  </aside>

  <!-- MAIN CONTENT FORM -->
  <main class="content p-4">
    <div class="container-fluid" style="max-width: 900px;">
      <div class="mb-4">
        <h1 class="fs-3 fw-bold mb-1">Tambah Produk / Unit Baru</h1>
        <p class="text-muted">Isi formulir di bawah ini untuk menambahkan barang inventaris baru.</p>
      </div>

      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
          <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Produk</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: PlayStation 5" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Harga Sewa (Rp)</label>
                <input type="number" name="price" class="form-control" placeholder="20000" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Jumlah Stok</label>
                <input type="number" name="stock" class="form-control" placeholder="1" value="1" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Kategori</label>
                <select name="category" class="form-select">
                  <option value="Console PS" selected>Console PS</option>
                  <option value="Accessories">Accessories</option>
                  <option value="Gadgets">Gadgets</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Deskripsi Produk</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat produk..."></textarea>
              </div>
              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary px-4 fw-semibold">Simpan Produk</button>
                <a href="/inventory" class="btn btn-light px-4 ms-2">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function toggleDarkMode() {
      const currentTheme = document.documentElement.getAttribute('data-bs-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-bs-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      updateThemeIcon(newTheme);
    }

    function updateThemeIcon(theme) {
      const icon = document.getElementById('themeIcon');
      if (icon) {
        icon.className = theme === 'dark' ? 'ti ti-sun fs-5 text-warning' : 'ti ti-moon fs-5';
      }
    }

    (function () {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
      updateThemeIcon(savedTheme);
    })();
  </script>
</body>
</html>