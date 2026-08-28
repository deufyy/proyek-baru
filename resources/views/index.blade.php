<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Rental PS Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon_io/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon_io/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon_io/favicon-16x16.png') }}">

  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Tabler Icons CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

  .stat-card { min-height: 100px; display: flex; align-items: center; }
  .stat-icon { width: 54px; height: 54px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

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
      <!-- TOMBOL DARK MODE / LIGHT MODE TOGGLE -->
      <button class="btn btn-light btn-icon rounded-circle" id="themeToggleBtn" onclick="toggleDarkMode()">
        <i class="ti ti-moon fs-5" id="themeIcon"></i>
      </button>

      <!-- DROPDOWN NOTIFIKASI -->
      <div class="dropdown">
        <button class="btn btn-light position-relative btn-icon rounded-circle" type="button" id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="ti ti-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            2
          </span>
        </button>

        <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0 mt-3" style="width: 320px; z-index: 1050; margin-top: 14px !important;">
          <div class="p-3 bg-danger bg-gradient text-white rounded-top d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0"><i class="ti ti-alert-triangle me-2"></i>Sewa Hampir Habis!</h6>
            <span class="badge bg-white text-danger">2 Unit</span>
          </div>

          <div class="list-group list-group-flush small" style="max-height: 280px; overflow-y: auto;">
            <a href="/reports" class="list-group-item list-group-item-action p-3">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <strong>mingyu (Wireless Earphones)</strong>
                <span class="badge bg-danger-subtle text-danger">⏱️ Habis</span>
              </div>
              <p class="mb-0 text-muted small">Waktu sewa telah berakhir! Segera matikan unit.</p>
            </a>

            <a href="/reports" class="list-group-item list-group-item-action p-3">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <strong>ditad (PC / PS5)</strong>
                <span class="badge bg-warning-subtle text-warning">⏱️ 00:05:00</span>
              </div>
              <p class="mb-0 text-muted small">Sisa waktu tinggal 5 menit lagi.</p>
            </a>
          </div>

          <div class="p-2 text-center rounded-bottom border-top">
            <a href="/reports" class="text-decoration-none fw-semibold small text-primary">
              Lihat Semua Laporan <i class="ti ti-chevron-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- PROFILE DROPDOWN -->
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
      <li class="nav-item"><a class="nav-link active" href="/dashboard"><i class="ti ti-smart-home me-3"></i>Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="/inventory"><i class="ti ti-device-gamepad me-3"></i>Daftar Unit PS</a></li>
      <li class="nav-item"><a class="nav-link" href="/create-product"><i class="ti ti-plus me-3"></i>Tambah Unit</a></li>
      <li class="nav-item"><a class="nav-link" href="/create-transaction"><i class="ti ti-shopping-cart-plus me-3"></i>Sewa Baru</a></li>
      <li class="nav-item"><a class="nav-link" href="/reports"><i class="ti ti-receipt me-3"></i>Laporan Rental</a></li>
    </ul>

    <div class="small text-uppercase fw-bold text-muted mt-4 mb-2 px-3">ACCOUNT</div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link text-danger" href="/logout">
          <i class="ti ti-logout me-3"></i>Logout
        </a>
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
          <h1 class="fs-3 fw-bold mb-1">Dashboard Rental PS</h1>
          <p class="text-muted mb-0">Selamat datang di sistem manajemen unit dan persewaan PlayStation!</p>
        </div>
        <a href="/create-transaction" class="btn btn-primary fw-semibold px-3 py-2 shadow-sm">
          <i class="ti ti-plus me-2"></i>Sewa Baru
        </a>
      </div>

      <!-- CARDS STATISTIK KINERJA -->
      <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
          <div class="card border-0 shadow-sm p-3 stat-card h-100">
            <div class="d-flex align-items-center gap-3 w-100">
              <div class="stat-icon bg-primary bg-gradient text-white rounded-3">
                <i class="ti ti-currency-dollar fs-2"></i>
              </div>
              <div class="overflow-hidden">
                <small class="text-muted d-block fw-semibold text-truncate">Total Pendapatan</small>
                <strong class="fs-5 text-nowrap">Rp 12.500.000</strong>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="card border-0 shadow-sm p-3 stat-card h-100">
            <div class="d-flex align-items-center gap-3 w-100">
              <div class="stat-icon bg-success bg-gradient text-white rounded-3">
                <i class="ti ti-shopping-cart fs-2"></i>
              </div>
              <div class="overflow-hidden">
                <small class="text-muted d-block fw-semibold text-truncate">Total Transaksi</small>
                <strong class="fs-5 text-nowrap">128 Rental</strong>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="card border-0 shadow-sm p-3 stat-card h-100">
            <div class="d-flex align-items-center gap-3 w-100">
              <div class="stat-icon bg-info bg-gradient text-white rounded-3">
                <i class="ti ti-device-gamepad fs-2"></i>
              </div>
              <div class="overflow-hidden">
                <small class="text-muted d-block fw-semibold text-truncate">Unit Sedang Main</small>
                <strong class="fs-5 text-nowrap">6 Unit Active</strong>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="card border-0 shadow-sm p-3 stat-card h-100">
            <div class="d-flex align-items-center gap-3 w-100">
              <div class="stat-icon bg-warning bg-gradient text-white rounded-3">
                <i class="ti ti-clock-pause fs-2"></i>
              </div>
              <div class="overflow-hidden">
                <small class="text-muted d-block fw-semibold text-truncate">Sewa Pending</small>
                <strong class="fs-5 text-nowrap">2 Booking</strong>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- BARIS GRAFIK & STATISTIK KATEGORI -->
      <div class="row g-3 mb-4">
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="fw-bold mb-1">Grafik Tren Pendapatan</h5>
                <small class="text-muted">Pemasukan sewa 6 bulan terakhir</small>
              </div>
              <span class="badge bg-success-subtle text-success px-3 py-2 fw-semibold">+18.2% vs Bulan Lalu</span>
            </div>
            <div style="height: 280px;">
              <canvas id="revenueChart"></canvas>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-1">Persentase Sewa Unit</h5>
            <small class="text-muted mb-3 d-block">Berdasarkan kategori konsol favorit</small>
            <div style="height: 220px;" class="d-flex justify-content-center">
              <canvas id="categoryChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- TABEL AKTIVITAS TERBARU & MONITOR UNIT REAL-TIME -->
      <div class="row g-3">
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="fw-bold mb-0">Transaksi Rental Terbaru</h5>
              <a href="/reports" class="btn btn-sm btn-outline-primary fw-semibold">Lihat Semua</a>
            </div>

            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Pelanggan</th>
                    <th>Unit PS</th>
                    <th>Durasi</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="fw-semibold">mingyu</td>
                    <td>Wireless Earphones / PS5</td>
                    <td>1 Jam</td>
                    <td><span class="badge bg-warning-subtle text-warning">Sedang Main</span></td>
                  </tr>
                  <tr>
                    <td class="fw-semibold">ditad</td>
                    <td>PC Station 01</td>
                    <td>1 Jam</td>
                    <td><span class="badge bg-warning-subtle text-warning">Sedang Main</span></td>
                  </tr>
                  <tr>
                    <td class="fw-semibold">dita</td>
                    <td>PlayStation 5 (VIP 1)</td>
                    <td>1 Jam</td>
                    <td><span class="badge bg-success-subtle text-success">Lunas / Selesai</span></td>
                  </tr>
                  <tr>
                    <td class="fw-semibold">jeno</td>
                    <td>PlayStation 4 Slim</td>
                    <td>2 Jam</td>
                    <td><span class="badge bg-success-subtle text-success">Lunas / Selesai</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm p-4">
            <h5 class="fw-bold mb-3">Status Ketersediaan Unit</h5>
            
            <div class="d-flex flex-column gap-2">
              <div class="p-3 border rounded-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                  <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
                  <strong class="small">PS5 - VIP Station 1</strong>
                </div>
                <span class="badge bg-success">Terpakai</span>
              </div>

              <div class="p-3 border rounded-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                  <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
                  <strong class="small">PS5 - VIP Station 2</strong>
                </div>
                <span class="badge bg-success">Terpakai</span>
              </div>

              <div class="p-3 border rounded-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                  <span class="badge rounded-pill bg-secondary" style="width:10px; height:10px; padding:0;"></span>
                  <strong class="small">PS4 - Regular Station 1</strong>
                </div>
                <span class="badge bg-secondary-subtle text-secondary">Tersedia</span>
              </div>

              <div class="p-3 border rounded-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                  <span class="badge rounded-pill bg-secondary" style="width:10px; height:10px; padding:0;"></span>
                  <strong class="small">PS4 - Regular Station 2</strong>
                </div>
                <span class="badge bg-secondary-subtle text-secondary">Tersedia</span>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- LOGIKA DARK MODE & CHART.JS -->
  <script>
    // LOGIKA FITUR DARK MODE / WHITE MODE
    function toggleDarkMode() {
      const currentTheme = document.documentElement.getAttribute('data-bs-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-bs-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      
      updateThemeIcon(newTheme);
    }

    function updateThemeIcon(theme) {
      const icon = document.getElementById('themeIcon');
      if (theme === 'dark') {
        icon.className = 'ti ti-sun fs-5 text-warning';
      } else {
        icon.className = 'ti ti-moon fs-5';
      }
    }

    // CEK SIMPANAN TEMA SAAT HALAMAN DIMUAT
    (function () {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
      updateThemeIcon(savedTheme);
    })();

    // CHART TREN PENDAPATAN
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
      type: 'line',
      data: {
        labels: ['Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus'],
        datasets: [{
          label: 'Pendapatan (Rp)',
          data: [6500000, 7800000, 9200000, 8900000, 11000000, 12500000],
          borderColor: '#4f46e5',
          backgroundColor: 'rgba(79, 70, 229, 0.1)',
          fill: true,
          tension: 0.4,
          borderWidth: 3,
          pointBackgroundColor: '#4f46e5'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: 'rgba(150,150,150,0.1)' } },
          x: { grid: { display: false } }
        }
      }
    });

    // CHART PERSENTASE SEWA
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
      type: 'doughnut',
      data: {
        labels: ['PS5 VIP', 'PS4 Slim', 'PC Gaming', 'Aksesoris'],
        datasets: [{
          data: [45, 30, 15, 10],
          backgroundColor: ['#4f46e5', '#3b82f6', '#10b981', '#f59e0b'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
      }
    });
  </script>

</body>

</html>