<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dizamatra Powerindo - Barang Keluar</title>
  
  <!-- Bootstrap CSS dan Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Font (Poppins) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- QR Code Scanner Library -->
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  
  <style>
    :root {
      --primary-color: #1b5e20; /* Dark Green */
      --secondary-color: #43a047; /* Medium Green */
      --accent-color: #81c784; /* Light Green */
      --accent-light: #e8f5e9; /* Very Light Green */
      --complementary: #7e57c2; /* Purple - complementary to green */
      --complementary-light: #d1c4e9; /* Light Purple */
      --text-color: #263238; /* Dark Blue-Gray */
      --light-text: #546e7a; /* Medium Blue-Gray */
      --background: #f5f7fa; /* Very Light Gray */
      --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      --hover-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }
    
    body {
      background: linear-gradient(135deg, var(--background) 0%, #e4eaef 100%);
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      overflow-x: hidden;
      padding-top: 70px;
      padding-left: 80px;
      color: var(--text-color);
    }
    
    header {
      background: #fff;
      padding: 12px 25px;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .logo {
      height: 50px;
      filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.1));
      transition: transform 0.3s ease;
    }
    
    .logo:hover {
      transform: scale(1.05);
    }
    
    .welcome-text {
      font-weight: 500;
      color: var(--primary-color);
    }
    
    /* Improved Sidebar Styles */
    .sidebar {
      background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
      width: 80px;
      height: calc(100vh - 70px);
      position: fixed;
      top: 70px;
      left: 0;
      display: flex;
      flex-direction: column;
      padding-top: 15px;
      transition: all 0.3s ease;
      z-index: 99;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .sidebar:hover {
      width: 220px;
    }

    .sidebar-item {
      width: 100%;
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: rgba(255,255,255,0.9);
      text-decoration: none;
      transition: all 0.3s ease;
      border-left: 4px solid transparent;
      font-weight: 500;
    }

    .sidebar-item:hover {
      background-color: rgba(255,255,255,0.15);
      color: white;
    }

    .sidebar-item.active {
      background-color: rgba(0,0,0,0.2);
      border-left: 4px solid var(--accent-color);
      color: white;
    }

    .sidebar-icon {
      width: 40px;
      text-align: center;
      font-size: 20px;
      transition: all 0.3s ease;
    }

    .sidebar-text {
      white-space: nowrap;
      opacity: 0;
      transition: opacity 0.2s ease 0.1s;
      font-size: 15px;
      margin-left: 15px;
    }

    .sidebar:hover .sidebar-text {
      opacity: 1;
    }

    .sidebar-footer {
      margin-top: auto;
      padding: 20px;
      border-top: 1px solid rgba(255,255,255,0.1);
      color: white;
      text-align: center;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s ease;
      font-weight: 300;
    }

    .sidebar:hover .sidebar-footer {
      opacity: 0.7;
    }

    /* Responsive adjustments for sidebar */
    @media (max-width: 768px) {
      body {
        padding-left: 0;
        padding-bottom: 60px;
      }
      
      .sidebar {
        width: 100%;
        height: 60px;
        top: auto;
        bottom: 0;
        flex-direction: row;
        padding: 0;
        justify-content: space-around;
      }
      
      .sidebar:hover {
        width: 100%;
      }
      
      .sidebar-item {
        flex-direction: column;
        padding: 8px 5px;
        font-size: 12px;
        border-left: none;
        border-top: 3px solid transparent;
      }
      
      .sidebar-item.active {
        border-left: none;
        border-top: 3px solid var(--accent-color);
      }
      
      .sidebar-icon {
        width: auto;
        font-size: 18px;
        margin-bottom: 3px;
      }
      
      .sidebar-text {
        opacity: 1;
        font-size: 10px;
        margin-left: 0;
      }
      
      .sidebar-footer {
        display: none;
      }
    }
    
    main {
      padding: 20px;
      transition: all 0.3s ease;
    }
    
    .section-title {
      background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 15px;
      border-radius: 12px;
      margin-bottom: 25px;
      box-shadow: var(--card-shadow);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .card-custom {
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      background: white;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      border: none;
      margin-bottom: 25px;
    }
    
    .card-custom:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }
    
    .logout-btn {
      margin-left: 10px;
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 8px 15px;
      transition: all 0.3s ease;
      font-weight: 600;
      border-radius: 10px;
      background-color: #e53935;
      border-color: #e53935;
      box-shadow: 0 4px 8px rgba(229, 57, 53, 0.25);
    }
    
    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(229, 57, 53, 0.35);
      background-color: #d32f2f;
      border-color: #d32f2f;
    }
    
    .date-display {
      margin-right: 15px;
      font-weight: 500;
      color: var(--primary-color);
    }
    
    .header-actions {
      display: flex;
      align-items: center;
    }
    
    /* Search Container */
    .search-container {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
      width: 100%;
      max-width: 350px;
      margin-left: auto;
      transition: all 0.3s ease;
    }
    
    .search-container:hover {
      transform: scale(1.02);
    }
    
    .search-input-group {
      position: relative;
      width: 100%;
    }
    
    .search-input {
      border-radius: 50px;
      padding: 10px 20px 10px 45px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      font-size: 14px;
      transition: all 0.3s ease;
      background-color: rgba(255, 255, 255, 0.2);
      color: white;
      width: 100%;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(5px);
    }
    
    .search-input::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }
    
    .search-input:focus {
      box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.3);
      border-color: white;
      background-color: rgba(255, 255, 255, 0.25);
      outline: none;
    }
    
    .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: white;
      font-size: 18px;
      z-index: 10;
      pointer-events: none;
    }
    
    .search-button {
      position: absolute;
      right: 5px;
      top: 50%;
      transform: translateY(-50%);
      border-radius: 50%;
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      color: var(--primary-color);
      border: none;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      transition: all 0.3s ease;
    }
    
    .search-button:hover {
      transform: translateY(-50%) scale(1.1);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }
    
    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 12px;
    }
    
    .btn-scan {
      position: relative;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      border-radius: 50px;
      font-weight: 500;
      transition: all 0.3s ease;
      overflow: hidden;
      z-index: 1;
      border: none;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
      background:#005AFF;
      color: white;
    }
    
    .btn-scan::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(255,255,255,0.15), rgba(255,255,255,0));
      z-index: -1;
      transition: all 0.3s ease;
    }
    
    .btn-scan:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      color: white;
    }
    
    .btn-scan:hover::before {
      opacity: 0.8;
    }
    
    .btn-scan i {
      font-size: 16px;
      transform: scale(1);
      transition: transform 0.3s ease;
    }
    
    .btn-scan:hover i {
      transform: scale(1.2);
    }
    
    /* Table Styles */
    .table-responsive {
      background: white;
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
      margin-bottom: 25px;
    }
    
    .table {
      margin-bottom: 0;
    }
    
    .table th {
      background-color: var(--accent-light);
      color: var(--primary-color);
      font-weight: 600;
      border-bottom: 2px solid var(--secondary-color);
      padding: 12px 15px;
    }
    
    .table td {
      padding: 12px 15px;
      vertical-align: middle;
      border-color: #f0f0f0;
    }
    
    .btn-action-table {
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.2s ease;
    }
    
    .btn-action-table:hover {
      transform: translateY(-2px);
    }
    
    .badge {
      padding: 6px 10px;
      font-weight: 500;
      border-radius: 8px;
    }
    
    /* Form and Input Styles */
    .form-control {
      border-radius: 10px;
      border: 1px solid #dce4e8;
      padding: 12px 15px;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(27, 94, 32, 0.15);
    }
    
    .form-label {
      font-weight: 500;
      color: var(--text-color);
      margin-bottom: 8px;
    }
    
    .input-group-text {
      background-color: var(--accent-light);
      color: var(--primary-color);
      border-color: #dce4e8;
      border-radius: 10px 0 0 10px;
    }
    
    /* Filter Section */
    .filter-section {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: var(--card-shadow);
    }
    
    /* Scanner Modal */
    .modal-scan .modal-content {
      border: none;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    
    .modal-scan .modal-header {
      background: linear-gradient(45deg, var(--complementary), #9575cd);
      border-bottom: none;
      padding: 20px 25px;
      align-items: center;
    }
    
    .modal-scan .modal-title {
      font-weight: 600;
      font-size: 1.25rem;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .modal-scan .btn-close {
      background-color: rgba(255, 255, 255, 0.5);
      border-radius: 50%;
      opacity: 1;
      width: 28px;
      height: 28px;
      transition: all 0.3s ease;
    }
    
    .modal-scan .btn-close:hover {
      background-color: white;
      transform: rotate(90deg);
    }
    
    .modal-scan .modal-body {
      padding: 25px;
      background-color: #f8f9fa;
    }
    
    .scanner-container {
      background-color: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      position: relative;
    }
    
    #reader {
      width: 100% !important;
      border: none !important;
      box-shadow: none !important;
      border-radius: 12px;
      overflow: hidden;
    }
    
    #reader__dashboard_section {
      padding: 15px !important;
      background-color: var(--accent-light) !important;
    }
    
    #reader__dashboard_section_csr button {
      background-color: var(--complementary) !important;
      color: white !important;
      border: none !important;
      border-radius: 50px !important;
      padding: 8px 20px !important;
      font-weight: 500 !important;
      box-shadow: 0 4px 12px rgba(126, 87, 194, 0.25) !important;
      transition: all 0.3s ease !important;
    }
    
    #reader__dashboard_section_csr button:hover {
      transform: translateY(-2px) !important;
      box-shadow: 0 6px 15px rgba(126, 87, 194, 0.35) !important;
    }
    
    #reader__scan_region {
      background-color: var(--accent-light) !important;
      border-radius: 0 0 12px 12px;
    }
    
    #reader__scan_region > img {
      max-width: 60% !important;
      height: auto !important;
    }
    
    /* Outgoing/Form Panel */
    .panel-outgoing {
      background: white;
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      padding: 25px;
      margin-bottom: 25px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .panel-outgoing:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }
    
    .panel-title {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 20px;
      border-bottom: 2px solid var(--accent-light);
      padding-bottom: 10px;
    }
    
    .item-selected {
      background-color: var(--accent-light);
      border-left: 4px solid var(--primary-color);
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      position: relative;
      display: none;
    }
    
    .item-selected.active {
      display: block;
      animation: fadeIn 0.5s;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .item-details {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    
    .item-detail {
      background: white;
      padding: 10px 15px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      flex: 1 1 calc(33% - 10px);
      min-width: 150px;
    }
    
    .detail-label {
      font-size: 0.75rem;
      color: var(--light-text);
      margin-bottom: 5px;
    }
    
    .detail-value {
      font-weight: 600;
      color: var(--text-color);
    }
    
    .btn-process {
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      border: none;
      border-radius: 50px;
      padding: 12px 25px;
      font-weight: 500;
      color: white;
      box-shadow: 0 4px 12px rgba(27, 94, 32, 0.25);
      transition: all 0.3s ease;
      display: block;
      width: 100%;
    }
    
    .btn-process:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(27, 94, 32, 0.35);
    }
    
    .btn-cancel {
      background-color: #f5f5f5;
      color: var(--light-text);
      border: none;
      border-radius: 50px;
      padding: 12px 25px;
      font-weight: 500;
      transition: all 0.3s ease;
      margin-top: 10px;
      display: block;
      width: 100%;
    }
    
    .btn-cancel:hover {
      background-color: #e0e0e0;
    }
    
    /* Recent Outgoing Items */
    .recent-title {
      font-weight: 600;
      color: var(--primary-color);
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .recent-title i {
      background: var(--accent-light);
      color: var(--primary-color);
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }
    
    .reservation-number {
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 8px 15px;
      border-radius: 8px;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 15px;
      box-shadow: 0 4px 12px rgba(27, 94, 32, 0.25);
    }

    /* Selected Items Table */
    #selectedItemsTable {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
    }

    #selectedItemsTable th {
      background-color: var(--accent-light);
      color: var(--primary-color);
      font-weight: 500;
      font-size: 0.8rem;
      padding: 8px 12px;
    }

    #selectedItemsTable td {
      padding: 8px 12px;
      font-size: 0.9rem;
      vertical-align: middle;
    }

    #selectedItemsTable .btn-sm {
      padding: 0.25rem 0.5rem;
      font-size: 0.75rem;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header>
    <img src="../asssets/image/logodz.png" alt="Logo Dizamatra Powerindo" class="logo">
    <div class="header-actions">
      <span class="date-display" id="current-date"></span>
      <div>
        <a href="../auth/logout.php" class="btn btn-danger logout-btn">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>
  </header>

  <!-- Improved Sidebar -->
    <div class="sidebar">
      <a href="home.php" class="sidebar-item">
        <div class="sidebar-icon"><i class="fas fa-home"></i></div>
        <span class="sidebar-text">Home</span>
      </a>
      <a href="daftar.php" class="sidebar-item">
        <div class="sidebar-icon"><i class="fas fa-box"></i></div>
        <span class="sidebar-text">Daftar</span>
      </a>
      <a href="keluar.php" class="sidebar-item active">
        <div class="sidebar-icon"><i class="fas fa-truck-loading"></i></div>
        <span class="sidebar-text">Keluar</span>
      </a>
      <a href="masuk.php" class="sidebar-item">
        <div class="sidebar-icon"><i class="fas fa-dolly-flatbed"></i></div>
        <span class="sidebar-text">Masuk</span>
      </a>
      <a href="laporan.php" class="sidebar-item">
        <div class="sidebar-icon"><i class="fas fa-chart-bar"></i></div>
        <span class="sidebar-text">Laporan</span>
      </a>
      
      <div class="sidebar-footer">
        Dizamatra Powerindo &copy; 2025
      </div>
    </div>

  <!-- Main Content -->
  <main class="container-fluid">
    <div class="section-title">
      <h4><i class="fas fa-truck-loading me-2"></i> Barang Keluar</h4>
      
      <!-- Search Container -->
      <div class="search-container">
        <div class="search-input-group me-2">
          <i class="fas fa-search search-icon"></i>
          <input type="text" class="search-input" id="searchItem" placeholder="Cari barang...">
          <button class="search-button" id="searchBtn">
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>
      
      <!-- Scan Button -->
      <div class="action-buttons">
        <button class="btn-scan" data-bs-toggle="modal" data-bs-target="#scanModal">
          <i class="fas fa-qrcode"></i> Scan QR
        </button>
      </div>
    </div>

    <div class="row">
      <!-- Form Panel -->
      <div class="col-lg-7">
        <div class="panel-outgoing">
          <h5 class="panel-title"><i class="fas fa-clipboard-list me-2"></i> Form Barang Keluar</h5>
          
          <!-- Item Selected Panel -->
          <div class="item-selected" id="selectedItemPanel">
            <h6 class="mb-3">Item Terpilih</h6>
            <div class="item-details">
              <div class="item-detail">
                <div class="detail-label">Part Number</div>
                <div class="detail-value" id="selectedPartNumber">-</div>
              </div>
              <div class="item-detail">
                <div class="detail-label">Nama Barang</div>
                <div class="detail-value" id="selectedItemName">-</div>
              </div>
              <div class="item-detail">
                <div class="detail-label">Merk</div>
                <div class="detail-value" id="selectedBrand">-</div>
              </div>
              <div class="item-detail">
                <div class="detail-label">Stok Tersedia</div>
                <div class="detail-value" id="selectedStock">-</div>
              </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm mt-2" id="addItemBtn">
              <i class="fas fa-plus me-1"></i> Tambahkan ke Reservasi
            </button>
          </div>
          
          <!-- Form -->
          <form id="outgoingForm">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="reservationNumber" class="form-label">No. Reservasi</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                  <input type="text" class="form-control" id="reservationNumber" readonly>
                </div>
                <small class="text-muted">Otomatis dibuat sistem</small>
              </div>
              <div class="col-md-6">
                <label for="outgoingDate" class="form-label">Tanggal Keluar</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                  <input type="text" class="form-control" id="outgoingDate" readonly>
                </div>
              </div>
            </div>
            
            <!-- Selected Items Table -->
            <div class="mb-3">
              <h6 class="mb-2">Barang yang akan dikeluarkan:</h6>
              <div class="table-responsive">
                <table class="table table-sm" id="selectedItemsTable">
                  <thead>
                    <tr>
                      <th>Part Number</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="selectedItemsBody">
                    <!-- Items will be added here dynamically -->
                    <tr>
                      <td colspan="4" class="text-center">Belum ada barang yang dipilih</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            
            <div class="row mb-4">
              <div class="col-md-12">
                <label for="recipient" class="form-label">Penerima / Tujuan</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-building"></i></span>
                  <input type="text" class="form-control" id="recipient" placeholder="Nama penerima/perusahaan" required>
                </div>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="notes" class="form-label">Catatan (Opsional)</label>
              <textarea class="form-control" id="notes" rows="3" placeholder="Catatan tambahan"></textarea>
            </div>
            
            <button type="submit" class="btn-process" id="processButton" disabled>
              <i class="fas fa-check-circle me-2"></i> Proses Reservasi
            </button>
            <button type="button" class="btn-cancel" id="cancelButton">
              <i class="fas fa-times-circle me-2"></i> Batal
            </button>
          </form>
        </div>
      </div>
      
      <!-- Recent Items Panel -->
      <div class="col-lg-5">
        <div class="panel-outgoing">
          <h5 class="recent-title"><i class="fas fa-history"></i> Barang Keluar Terakhir</h5>
          
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No. Reservasi</th>
                  <th>Tanggal</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="recentItemsBody">
                <!-- Recent items will be dynamically inserted here -->
                <tr>
                  <td>RES-20240503-1234</td>
                  <td>03/05/2024</td>
                  <td>Bearing 6204ZZ</td>
                  <td>5</td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary">
                      <i class="fas fa-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>RES-20240502-5678</td>
                  <td>02/05/2024</td>
                  <td>V-Belt A56</td>
                  <td>3</td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary">
                      <i class="fas fa-eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- QR Code Scanner Modal -->
  <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-scan">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scanModalLabel"><i class="fas fa-qrcode me-2"></i> Scan QR Code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="scanner-container">
            <div id="reader"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Data structure to hold selected items
        const selectedItems = [];
        let currentReservationNumber = generateReservationNumber();
        let html5QrcodeScanner = null;
        
        // Set initial reservation number and date
        document.getElementById('reservationNumber').value = currentReservationNumber;
        document.getElementById('outgoingDate').value = new Date().toLocaleDateString('id-ID');
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('id-ID', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
        
        // Function to generate reservation number
        function generateReservationNumber() {
          const date = new Date();
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          const random = Math.floor(1000 + Math.random() * 9000);
          return `RES-${year}${month}${day}-${random}`;
        }
        
        // Function to show item details
        function showItemDetails(item) {
          document.getElementById('selectedPartNumber').textContent = item.partNumber;
          document.getElementById('selectedItemName').textContent = item.name;
          document.getElementById('selectedBrand').textContent = item.brand;
          document.getElementById('selectedStock').textContent = item.stock;
          document.getElementById('selectedItemPanel').classList.add('active');
          document.getElementById('quantity').value = 1;
        }
        
        // Function to add item to reservation
        function addItemToReservation(item, quantity) {
          // Check if item already exists in reservation
          const existingItemIndex = selectedItems.findIndex(i => i.partNumber === item.partNumber);
          
          if (existingItemIndex >= 0) {
            // Update quantity if item exists
            selectedItems[existingItemIndex].quantity += quantity;
          } else {
            // Add new item
            selectedItems.push({
              ...item,
              quantity: quantity
            });
          }
          
          updateSelectedItemsTable();
          updateProcessButton();
        }
        
        // Function to update selected items table
        function updateSelectedItemsTable() {
          const tbody = document.getElementById('selectedItemsBody');
          tbody.innerHTML = '';
          
          if (selectedItems.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">Belum ada barang yang dipilih</td></tr>';
            return;
          }
          
          selectedItems.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${item.partNumber}</td>
              <td>${item.name}</td>
              <td>${item.quantity}</td>
              <td>
                <button type="button" class="btn btn-danger btn-sm remove-item" data-index="${index}">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            `;
            tbody.appendChild(row);
          });
          
          // Add event listeners to remove buttons
          document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
              const index = parseInt(this.getAttribute('data-index'));
              selectedItems.splice(index, 1);
              updateSelectedItemsTable();
              updateProcessButton();
    </script>
</body>
</html>
