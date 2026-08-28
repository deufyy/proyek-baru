<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Laporan Rental - Rental PS Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
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

  /* STYLING SIDEBAR MODERN DARK */
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
  .table { color: var(--text-color); }

  [data-bs-theme="dark"] .table-light { 
    background-color: #334155; 
    color: #f8fafc; 
  }

  [data-bs-theme="dark"] .form-control, 
  [data-bs-theme="dark"] .form-select { 
    background-color: #0f172a; 
    color: #fff; 
    border-color: #334155; 
  }

  [data-bs-theme="dark"] .modal-content {
    background-color: #1e293b;
    color: #f8fafc;
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

      <!-- DROPDOWN NOTIFIKASI -->
      <div class="dropdown">
        <button class="btn btn-light position-relative btn-icon rounded-circle" type="button" id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="ti ti-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
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
        <a class="nav-link" href="/create-transaction">
          <i class="ti ti-shopping-cart-plus me-3"></i>Sewa Baru
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/reports">
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
    <div class="container-fluid">
      
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
          <i class="ti ti-circle-check me-2 fs-5"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h1 class="fs-3 fw-bold mb-1">Laporan Penyewaan</h1>
          <p class="text-muted mb-0">Ringkasan transaksi dan pencarian riwayat rental.</p>
        </div>
        <a href="/create-transaction" class="btn btn-primary fw-semibold px-3 py-2">
          <i class="ti ti-plus me-2"></i>Sewa Baru
        </a>
      </div>

      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-transparent py-3 border-0 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
          <h5 class="fw-bold mb-0">Monitoring Sisa Waktu & Riwayat</h5>
          
          <div class="position-relative" style="max-width: 300px; width: 100%;">
            <input type="text" id="searchInput" onkeyup="cariTransaksi()" class="form-control ps-5" placeholder="Cari nama / ID transaksi...">
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0" id="tabelTransaksi">
            <thead class="table-light">
              <tr>
                <th class="ps-4">ID TRX</th>
                <th>Peminjam</th>
                <th>Unit PS</th>
                <th>Durasi</th>
                <th>Sisa Waktu Main ⏱️</th>
                <th>Metode</th>
                <th>Status</th>
                <th class="text-end pe-4">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $trx)
                @php
                  $endTime = $trx->created_at->addHours((int)$trx->quantity);
                @endphp
                <tr>
                  <td class="ps-4 fw-semibold text-primary">#{{ $trx->trx_id }}</td>
                  <td class="nama-pelanggan">{{ $trx->customer_name }}</td>
                  <td>{{ $trx->product->name ?? 'Unit Dihapus' }}</td>
                  <td>{{ $trx->quantity }} Jam</td>
                  
                  <td>
                    @if($trx->status == 'Pending')
                      <span class="badge bg-primary fs-6 font-monospace timer-countdown" 
                            data-trx-db-id="{{ $trx->id }}"
                            data-trx-id="{{ $trx->trx_id }}"
                            data-customer="{{ $trx->customer_name }}"
                            data-unit="{{ $trx->product->name ?? 'Unit PS' }}"
                            data-endtime="{{ $endTime->toIso8601String() }}">
                        00:00:00
                      </span>
                    @elseif($trx->status == 'Lunas')
                      <span class="badge bg-secondary-subtle text-secondary">Selesai Main</span>
                    @else
                      <span class="badge bg-danger-subtle text-danger">Dibatalkan</span>
                    @endif
                  </td>

                  <td><span class="badge bg-light text-dark border">{{ $trx->payment_method ?? 'Cash' }}</span></td>
                  <td>
                    @if($trx->status == 'Lunas')
                      <span class="badge bg-success-subtle text-success">Lunas</span>
                    @elseif($trx->status == 'Pending')
                      <span class="badge bg-warning-subtle text-warning">Sedang Main</span>
                    @else
                      <span class="badge bg-danger-subtle text-danger">Batal</span>
                    @endif
                  </td>
                  <td class="text-end pe-4">
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-2 me-1" 
                            onclick="bukaStruk('{{ $trx->trx_id }}', '{{ $trx->created_at->format('d/m/Y H:i') }}', '{{ $trx->customer_name }}', '{{ $trx->product->name ?? 'Unit PS' }}', '{{ $trx->quantity }}', '{{ number_format((int)$trx->total_price, 0, ',', '.') }}', '{{ $trx->payment_method ?? 'Cash' }}')">
                      <i class="ti ti-printer me-1"></i>Struk
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-2" onclick="bukaModalEdit('{{ $trx->id }}', '{{ $trx->customer_name }}', '{{ $trx->status }}')">
                      Edit
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center py-4 text-muted">Belum ada transaksi penyewaan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>

  <!-- MODAL NOTIFIKASI WAKTU HABIS -->
  <div class="modal fade" id="modalWaktuHabis" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title fw-bold"><i class="ti ti-bell-ringing me-2"></i>WAKTU MAIN SELESAI!</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-4">
          <div class="p-3 bg-danger-subtle rounded-circle d-inline-block mb-3">
            <i class="ti ti-clock-off text-danger fs-1"></i>
          </div>
          <h4 class="fw-bold mb-1" id="notifNamaPeminjam">Nama Pelanggan</h4>
          <p class="text-muted mb-3" id="notifUnit">Unit PS</p>
          <div class="alert alert-warning border-0 small">
            Durasi sewa untuk unit ini sudah berakhir. Harap matikan unit PS atau konfirmasi ke pelanggan.
          </div>
        </div>
        <div class="modal-footer bg-light justify-content-center">
          <form id="formMatikanPs" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="Lunas">
            <button type="submit" class="btn btn-danger px-4 fw-semibold">
              Saya Mengerti / Matikan PS
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL STRUK -->
  <div class="modal fade" id="modalStruk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 360px;">
      <div class="modal-content border-0 shadow">
        <div class="modal-body p-4" id="areaStruk">
          <div class="text-center mb-3">
            <h5 class="fw-bold mb-0">RENTAL PS STORE</h5>
            <small class="text-muted d-block">Jl. Raya Game Center No. 12</small>
            <small class="text-muted">Telp/WA: 0812-3456-7890</small>
          </div>
          <div class="border-top border-bottom py-2 my-2 text-monospace small">
            <div class="d-flex justify-content-between"><span>No Nota:</span> <strong id="strukId">#RENT-000</strong></div>
            <div class="d-flex justify-content-between"><span>Tgl:</span> <span id="strukTgl">-</span></div>
            <div class="d-flex justify-content-between"><span>Pelanggan:</span> <span id="strukNama">-</span></div>
          </div>
          <div class="py-2 border-bottom text-monospace small">
            <div class="fw-bold mb-1" id="strukUnit">Unit PS</div>
            <div class="d-flex justify-content-between">
              <span id="strukQty">1 Jam</span>
              <strong id="strukTotal">Rp 0</strong>
            </div>
          </div>
          <div class="py-2 text-monospace small">
            <div class="d-flex justify-content-between">
              <span>Metode Bayar:</span>
              <strong id="strukMetode">Cash</strong>
            </div>
          </div>
          <div class="text-center mt-3 pt-2 border-top">
            <small class="fw-bold d-block">*** TERIMA KASIH ***</small>
            <small class="text-muted" style="font-size: 10px;">Selamat Bermain & Jagalah Kebersihan</small>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary fw-semibold" onclick="window.print()">
            <i class="ti ti-printer me-1"></i>Cetak Struk
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT STATUS -->
  <div class="modal fade" id="modalEditStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Update Status Penyewaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formUpdateStatus" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <p class="mb-3 text-muted">Ubah status penyewaan untuk <strong id="namaPeminjamModal"></strong>:</p>
            <div class="mb-3">
              <label class="form-label fw-semibold">Status Transaksi</label>
              <select name="status" id="selectStatusModal" class="form-select" required>
                <option value="Lunas">Lunas / Selesai</option>
                <option value="Pending">Pending / Sedang Main</option>
                <option value="Batal">Batal</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary fw-semibold">Simpan Perubahan</button>
          </div>
        </form>
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

    // SCRIPT CARI TRANSAKSI & TIMER COUNTDOWN
    function cariTransaksi() {
      var input = document.getElementById("searchInput");
      var filter = input.value.toLowerCase();
      var table = document.getElementById("tabelTransaksi");
      var tr = table.getElementsByTagName("tr");

      for (var i = 1; i < tr.length; i++) {
        var rowText = tr[i].textContent || tr[i].innerText;
        if (rowText.toLowerCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    var notifikasiMuncul = {};

    function updateTimers() {
      var elements = document.querySelectorAll('.timer-countdown');
      var now = new Date().getTime();

      elements.forEach(function(el) {
        var endTime = new Date(el.getAttribute('data-endtime')).getTime();
        var distance = endTime - now;

        var trxDbId = el.getAttribute('data-trx-db-id');
        var trxId = el.getAttribute('data-trx-id');
        var customer = el.getAttribute('data-customer');
        var unit = el.getAttribute('data-unit');

        if (distance < 0) {
          el.innerHTML = "WAKTU HABIS!";
          el.className = "badge bg-danger fs-6";

          if (!notifikasiMuncul[trxId]) {
            notifikasiMuncul[trxId] = true;
            tampilkanNotifWaktuHabis(trxDbId, customer, unit);
          }
        } else {
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          hours = hours < 10 ? "0" + hours : hours;
          minutes = minutes < 10 ? "0" + minutes : minutes;
          seconds = seconds < 10 ? "0" + seconds : seconds;

          el.innerHTML = hours + ":" + minutes + ":" + seconds;
        }
      });
    }

    function tampilkanNotifWaktuHabis(idDb, nama, unit) {
      document.getElementById('notifNamaPeminjam').innerText = nama;
      document.getElementById('notifUnit').innerText = 'Unit: ' + unit;
      document.getElementById('formMatikanPs').action = '/transactions/' + idDb + '/status';
      
      var modal = new bootstrap.Modal(document.getElementById('modalWaktuHabis'));
      modal.show();
    }

    setInterval(updateTimers, 1000);
    updateTimers();

    function bukaStruk(id, tgl, nama, unit, qty, total, metode) {
      document.getElementById('strukId').innerText = '#' + id;
      document.getElementById('strukTgl').innerText = tgl;
      document.getElementById('strukNama').innerText = nama;
      document.getElementById('strukUnit').innerText = unit;
      document.getElementById('strukQty').innerText = qty + ' Jam';
      document.getElementById('strukTotal').innerText = 'Rp ' + total;
      document.getElementById('strukMetode').innerText = metode;

      var modalStruk = new bootstrap.Modal(document.getElementById('modalStruk'));
      modalStruk.show();
    }

    function bukaModalEdit(id, nama, status) {
      document.getElementById('namaPeminjamModal').innerText = nama;
      document.getElementById('selectStatusModal').value = status;
      document.getElementById('formUpdateStatus').action = '/transactions/' + id + '/status';
      
      var modal = new bootstrap.Modal(document.getElementById('modalEditStatus'));
      modal.show();
    }
  </script>

</body>

</html>