<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Daftar Unit PS - Rental PS Dashboard</title>
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

  body { background-color: var(--bg-body); color: var(--text-color); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; transition: background-color 0.3s, color 0.3s; }
  .sidebar { width: 260px; position: fixed; top: 0; left: 0; height: 100vh; background: #0f172a; z-index: 1000; padding: 24px 16px; box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08); }
  .sidebar .logo-area { padding: 0 12px 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); margin-bottom: 20px; }
  .sidebar .nav-link { color: #94a3b8 !important; font-weight: 500; padding: 10px 16px; border-radius: 10px; margin-bottom: 4px; display: flex; align-items: center; transition: all 0.2s; }
  .sidebar .nav-link:hover { color: #ffffff !important; background-color: rgba(255, 255, 255, 0.06); transform: translateX(4px); }
  .sidebar .nav-link.active { color: #ffffff !important; background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%) !important; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35); font-weight: 600; }
  
  .topbar { margin-left: 260px; width: calc(100% - 260px); z-index: 999; background-color: var(--topbar-bg) !important; border-bottom-color: var(--border-color) !important; transition: background-color 0.3s; }
  .content { margin-left: 260px; padding-top: 80px !important; }
  
  .card { border-radius: 12px; background-color: var(--bg-card); border-color: var(--border-color); color: var(--text-color); transition: background-color 0.3s, border-color 0.3s; }
  .text-muted { color: var(--text-muted) !important; }
  .table { color: var(--text-color); }
  [data-bs-theme="dark"] .table-light { background-color: #334155; color: #f8fafc; }

  @media (max-width: 991.98px) { .sidebar { display: none; } .topbar, .content { margin-left: 0; width: 100%; } }
</style>
</head>

<body>

  <!-- TOPBAR -->
  <nav id="topbar" class="navbar border-bottom fixed-top topbar px-3">
    <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>

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

  <!-- SIDEBAR -->
  <aside id="sidebar" class="sidebar">
    <div class="logo-area">
      <a href="/dashboard" class="d-inline-flex align-items-center text-decoration-none">
        <div class="p-2 rounded-3 bg-primary bg-gradient text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
          <i class="ti ti-device-gamepad-2 fs-4"></i>
        </div>
        <span class="fw-bold fs-5 ms-2 text-white">Rental PS</span>
      </a>
    </div>

    <div class="small text-uppercase fw-bold text-muted mb-2 px-3">MAIN MENU</div>
    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link" href="/dashboard"><i class="ti ti-smart-home me-3"></i>Dashboard</a></li>
      <li class="nav-item"><a class="nav-link active" href="/inventory"><i class="ti ti-device-gamepad me-3"></i>Daftar Unit PS</a></li>
      <li class="nav-item"><a class="nav-link" href="/create-product"><i class="ti ti-plus me-3"></i>Tambah Unit</a></li>
      <li class="nav-item"><a class="nav-link" href="/create-transaction"><i class="ti ti-shopping-cart-plus me-3"></i>Sewa Baru</a></li>
      <li class="nav-item"><a class="nav-link" href="/reports"><i class="ti ti-receipt me-3"></i>Laporan Rental</a></li>
    </ul>

    <div class="small text-uppercase fw-bold text-muted mt-4 mb-2 px-3">ACCOUNT</div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link text-danger" href="/logout"><i class="ti ti-logout me-3"></i>Logout</a>
      </li>
    </ul>
  </aside>

  <!-- MAIN CONTENT -->
  <main id="content" class="content p-4">
    <div class="container-fluid">
      
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
          <i class="ti ti-circle-check me-2 fs-5"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 fw-bold mb-1">Daftar Unit PS & Stok</h1>
          <p class="text-muted mb-0">Kelola konsol, harga sewa per jam, dan ketersediaan unit.</p>
        </div>
        <a href="/create-product" class="btn btn-primary fw-semibold px-3 py-2">
          <i class="ti ti-plus me-2"></i>Tambah Unit
        </a>
      </div>

      <div class="card border-0 shadow-sm rounded-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="ps-4">Nama Unit</th>
                <th>Harga / Jam</th>
                <th>Status</th>
                <th class="text-end pe-4">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products as $product)
                <tr>
                  <td class="ps-4 fw-semibold">{{ $product->name }}</td>
                  <td>Rp {{ number_format((int)$product->price, 0, ',', '.') }}</td>
                  <td><span class="badge bg-success-subtle text-success">{{ $product->status ?? 'Tersedia' }}</span></td>
                  <td class="text-end pe-4">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning me-1"><i class="ti ti-pencil me-1"></i>Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus unit ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger"><i class="ti ti-trash me-1"></i>Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-4 text-muted">Belum ada data unit PS.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
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
      if (icon) icon.className = theme === 'dark' ? 'ti ti-sun fs-5 text-warning' : 'ti ti-moon fs-5';
    }

    (function () {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
      updateThemeIcon(savedTheme);
    })();
  </script>
</body>
</html>