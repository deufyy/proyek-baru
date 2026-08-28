<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Sewa Baru - Rental PS Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon_io/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon_io/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon_io/favicon-16x16.png') }}">

  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Tabler Icons CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<style>
  /* VARIABEL DUAL THEME (LIGHT & DARK MODE) */
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
  
  /* STYLING SIDEBAR MODERN / PREMIUM DARK */
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

  /* TOPBAR & CARD DYNAMIC STYLING */
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
    <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>

    <div class="ms-auto d-flex align-items-center gap-3">
      <!-- TOMBOL TOGGLE DARK / LIGHT MODE -->
      <button class="btn btn-light btn-icon rounded-circle" id="themeToggleBtn" onclick="toggleDarkMode()">
        <i class="ti ti-moon fs-5" id="themeIcon"></i>
      </button>

      <a class="position-relative btn btn-light rounded-circle p-2" href="/reports">
        <i class="ti ti-bell fs-5"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
      </a>

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
        <a class="nav-link" href="/create-product">
          <i class="ti ti-plus me-3"></i>Tambah Unit
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/create-transaction">
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

  <!-- MAIN CONTENT -->
  <main id="content" class="content p-4">
    <div class="container-fluid" style="max-width: 900px;">
      
      <!-- Notifikasi Alert Error -->
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
          <i class="ti ti-alert-circle me-2 fs-5"></i>{{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="mb-4">
        <h1 class="fs-3 fw-bold mb-1">Pencatatan Sewa Baru</h1>
        <p class="text-muted">Isi formulir di bawah ini untuk mencatat transaksi persewaan unit PlayStation.</p>
      </div>

      <!-- FORM TRANSAKSI -->
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
          <form id="formTransaction" action="{{ route('transactions.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
              <!-- Nama Pelanggan -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Penyewa / Pelanggan</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Contoh: Budi Santoso" required>
              </div>

              <!-- Pilihan Unit PS -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">Pilih Unit PlayStation</label>
                <select name="product_id" id="product_id" class="form-select" required>
                  <option value="" disabled selected>-- Pilih Unit PS --</option>
                  @forelse($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                      {{ $product->name }} (Stok: {{ $product->stock }} | Rp {{ number_format((int)$product->price, 0, ',', '.') }}/jam)
                    </option>
                  @empty
                    <option value="" disabled>Belum ada unit PS di Inventory</option>
                  @endforelse
                </select>
              </div>

              <!-- Durasi Sewa -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">Durasi Sewa (Jam)</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="1" min="1" required>
              </div>

              <!-- Metode Pembayaran -->
              <div class="col-md-6">
                <label class="form-label fw-semibold">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="form-select" required>
                  <option value="Cash" selected>Cash (Tunai)</option>
                  <option value="QRIS">QRIS DANA</option>
                  <option value="Transfer">Transfer Bank</option>
                </select>
              </div>

              <!-- Status Transaksi -->
              <div class="col-md-12">
                <label class="form-label fw-semibold">Status Transaksi</label>
                <select name="status" class="form-select" required>
                  <option value="Lunas" selected>Lunas / Selesai</option>
                  <option value="Pending">Pending / Sedang Main</option>
                </select>
              </div>
            </div>

            <div class="mt-4 d-flex gap-2">
              <button type="button" onclick="prosesSimpan()" class="btn btn-primary fw-semibold px-4 py-2">
                Simpan Transaksi
              </button>
              <a href="/reports" class="btn btn-light fw-semibold px-4 py-2">Batal</a>
            </div>

          </form>
        </div>
      </div>

    </div>
  </main>

  <!-- MODAL QRIS DANA -->
  <div class="modal fade" id="modalQRIS" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title fw-bold"><i class="ti ti-qrcode me-2"></i>Pembayaran QRIS DANA</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-4">
          <p class="text-muted small mb-1">Scan QR Code menggunakan DANA / OVO / GoPay / ShopeePay / Mobile Banking:</p>
          
          <!-- GAMBAR QR CODE DANA -->
          <div class="p-3 bg-light border rounded-3 d-inline-block my-2">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=QRIS_RENTAL_PS_DANA" alt="QRIS DANA" class="img-fluid rounded">
          </div>

          <div class="mt-2">
            <span class="text-muted small d-block">Total Pembayaran:</span>
            <h4 class="fw-bold text-primary mb-0" id="totalBayarModal">Rp 0</h4>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary w-100 mb-2" data-bs-dismiss="modal">Batal</button>
          <button type="button" onclick="submitFormLangsung()" class="btn btn-success w-100 fw-semibold">
            <i class="ti ti-check me-1"></i>Konfirmasi Pembayaran Selesai
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JAVASCRIPT DARK MODE TOGGLE & SINKRONISASI -->
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

    // Otomatis terapkan mode tersimpan saat halaman dibuka
    (function () {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
      updateThemeIcon(savedTheme);
    })();

    // SCRIPT PROSES SIMPAN & POPUP QRIS
    function prosesSimpan() {
      var form = document.getElementById('formTransaction');

      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      var paymentMethod = document.getElementById('payment_method').value;

      if (paymentMethod === 'QRIS') {
        var selectProduct = document.getElementById('product_id');
        var selectedOption = selectProduct.options[selectProduct.selectedIndex];
        var price = selectedOption.getAttribute('data-price') || 0;
        var qty = document.getElementById('quantity').value || 1;
        var total = price * qty;

        document.getElementById('totalBayarModal').innerText = 'Rp ' + parseInt(total).toLocaleString('id-ID');

        var modalQRIS = new bootstrap.Modal(document.getElementById('modalQRIS'));
        modalQRIS.show();
      } else {
        form.submit();
      }
    }

    function submitFormLangsung() {
      document.getElementById('formTransaction').submit();
    }
  </script>
</body>

</html>