<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dizamatra Powerindo - Admin Panel</title>
  
  <!-- Bootstrap CSS dan Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Font (Poppins) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
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
      text-align: center;
      background: white;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      height: 100%;
      border: none;
    }
    
    .card-custom:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }
    
    .card-custom img {
      width: 120px;
      height: 120px;
      object-fit: contain;
      margin: 20px auto 10px;
      transition: transform 0.3s ease;
    }
    
    .card-custom:hover img {
      transform: scale(1.1);
    }
    
    .card-body {
      padding: 15px;
    }
    
    .item-code {
      font-weight: 700;
      margin-bottom: 5px;
      color: var(--text-color);
      font-size: 1.1rem;
    }
    
    .item-name {
      color: var(--primary-color);
      margin-bottom: 10px;
      font-weight: 600;
    }
    
    .item-actions {
      display: flex;
      justify-content: space-around;
      border-top: 1px solid #eee;
      padding-top: 10px;
      padding-bottom: 5px;
    }
    
    .btn-action {
      font-size: 20px;
      color: var(--light-text);
      background: none;
      border: none;
      padding: 5px;
      transition: all 0.2s ease;
    }
    
    .btn-view:hover {
      color: var(--complementary);
    }
    
    .btn-edit:hover {
      color: var(--secondary-color);
    }
    
    .btn-delete:hover {
      color: #e53935;
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
    
    .search-container {
      display: flex;
      gap: 10px;
      margin-bottom: 0;
    }
    
    .header-actions {
      display: flex;
      align-items: center;
    }
    
    .date-display {
      margin-right: 15px;
      font-weight: 500;
      color: var(--primary-color);
    }
    
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      margin-top: 30px;
    }
    
    .btn-add-item {
      display: flex;
      align-items: center;
      gap: 5px;
      border-radius: 10px;
      background-color: white;
      color: var(--primary-color);
      border: 1px solid var(--primary-color);
      padding: 8px 15px;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .btn-add-item:hover {
      background-color: var(--primary-color);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(27, 94, 32, 0.25);
    }
    
    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }
    
    .stat-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      display: flex;
      align-items: center;
      box-shadow: var(--card-shadow);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }
    
    .stat-icon {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 20px;
      font-size: 24px;
      color: white;
    }
    
    .stat-blue {
      background-color: var(--primary-color);
    }
    
    .stat-purple {
      background-color: var(--complementary);
    }
    
    .stat-orange {
      background-color: #ff7043;
    }
    
    .stat-green {
      background-color: var(--secondary-color);
    }
    
    .stat-info h3 {
      font-size: 24px;
      margin-bottom: 5px;
      font-weight: 700;
      color: var(--text-color);
    }
    
    .stat-info p {
      font-size: 14px;
      color: var(--light-text);
      margin: 0;
    }
    
    .badge-stock {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
    }
    
    .badge-low {
      background-color: #ffebee;
      color: #e53935;
    }
    
    .badge-out {
      background-color: #ffcdd2;
      color: #c62828;
    }
    
    .item-stock {
      font-size: 14px;
      padding: 3px 8px;
      border-radius: 10px;
      display: inline-block;
      margin-top: 5px;
    }
    
    .stock-high {
      background-color: var(--accent-light);
      color: var(--primary-color);
    }
    
    .stock-medium {
      background-color: #fff8e1;
      color: #ff8f00;
    }
    
    .stock-low {
      background-color: #ffebee;
      color: #c62828;
    }
    
    /* Modal styles */
    .modal-header {
      background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
      color: white;
    }
    
    .modal-body {
      padding: 20px;
    }
    
    /* Animation */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .fade-in {
      animation: fadeIn 0.5s ease forwards;
    }
    
    .search-input {
      border-radius: 10px;
      padding: 8px 12px 8px 40px;
      border: 1px solid #dce4e8;
      font-size: 14px;
      transition: all 0.3s ease;
      background-color: #f8f9fa;
      position: relative;
    }
    
    .search-input:focus {
      box-shadow: 0 0 0 3px rgba(27, 94, 32, 0.2);
      border-color: var(--primary-color);
      background-color: #fff;
    }
    
    .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--light-text);
      z-index: 10;
    }
    
    .search-button {
      border-radius: 10px;
      font-weight: 600;
      background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
      box-shadow: 0 4px 8px rgba(27, 94, 32, 0.25);
    }
    
    .search-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(27, 94, 32, 0.35);
    }
    
    .btn-print {
      display: flex;
      align-items: center;
      gap: 5px;
      border-radius: 10px;
      background-color: white;
      color: var(--complementary);
      border: 1px solid var(--complementary-light);
      padding: 8px 15px;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .btn-print:hover {
      background-color: var(--complementary);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(126, 87, 194, 0.25);
    }
    
    .progress {
      height: 10px;
      border-radius: 5px;
      overflow: hidden;
      background-color: #e9ecef;
      margin-bottom: 8px;
    }
    
    .progress-bar {
      background-color: var(--secondary-color);
    }
    
    .text-muted {
      color: var(--light-text) !important;
      font-size: 12px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      body {
        padding-top: 60px;
      }
      
      .section-title {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      
      .stats-container {
        grid-template-columns: 1fr;
        gap: 15px;
      }
      
      .logout-btn {
        position: absolute;
        top: 13px;
        right: 10px;
        padding: 5px 10px;
        font-size: 14px;
      }
      
      .welcome-text {
        font-size: 14px;
      }
      
      .header-actions {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .date-display {
        margin-bottom: 10px;
      }
    }
  </style>
</head>

<body>

<header>
  <img src="../assets/image/logodz.png" alt="Logo Dizamatra Powerindo" class="logo">
  <div class="header-actions">
    <span class="date-display" id="current-date"></span>
    <div>
      <a href="config/logout.php" class="btn btn-sm btn-danger logout-btn">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </div>
</header>

<!-- Improved Sidebar -->
<div class="sidebar">
  <a href="dashboard.html" class="sidebar-item active">
    <div class="sidebar-icon"><i class="fas fa-home"></i></div>
    <span class="sidebar-text">Home</span>
  </a>
  <a href="daftar.php" class="sidebar-item">
    <div class="sidebar-icon"><i class="fas fa-box"></i></div>
    <span class="sidebar-text">Daftar</span>
  </a>
  <a href="keluar.php" class="sidebar-item">
    <div class="sidebar-icon"><i class="fas fa-truck-loading"></i></div>
    <span class="sidebar-text">Keluar</span>
  </a>
  <a href="incoming.html" class="sidebar-item">
    <div class="sidebar-icon"><i class="fas fa-dolly-flatbed"></i></div>
    <span class="sidebar-text">Masuk</span>
  </a>
  <a href="reports.html" class="sidebar-item">
    <div class="sidebar-icon"><i class="fas fa-chart-bar"></i></div>
    <span class="sidebar-text">Laporan</span>
  </a>
  
  <div class="sidebar-footer">
    Dizamatra Powerindo &copy; 2025
  </div>
</div>

<!-- Main Content - Dashboard Only -->
<main class="container-fluid">
  <div class="section-title">
    <h4><i class="fas fa-tachometer-alt me-2"></i> Dashboard</h4>
    <div class="search-container">
      <div class="position-relative">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="form-control search-input" placeholder="Cari barang...">
      </div>
      <button class="btn btn-primary search-button"><i class="fas fa-search"></i></button>
    </div>
  </div>
  
  <!-- Statistics Cards -->
  <div class="stats-container">
    <div class="stat-card">
      <div class="stat-icon stat-blue">
        <i class="fas fa-box"></i>
      </div>
      <div class="stat-info">
        <h3>1,248</h3>
        <p>Total Item Tersedia</p>
      </div>
    </div>
    
    <div class="stat-card">
      <div class="stat-icon stat-purple">
        <i class="fas fa-truck-loading"></i>
      </div>
      <div class="stat-info">
        <h3>326</h3>
        <p>Barang Keluar Bulan Ini</p>
      </div>
    </div>
    
    <div class="stat-card">
      <div class="stat-icon stat-orange">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="stat-info">
        <h3>42</h3>
        <p>Stok Hampir Habis</p>
      </div>
    </div>
    
    <div class="stat-card">
      <div class="stat-icon stat-green">
        <i class="fas fa-dolly-flatbed"></i>
      </div>
      <div class="stat-info">
        <h3>189</h3>
        <p>Barang Masuk Bulan Ini</p>
      </div>
    </div>
  </div>
  
  <!-- Stok Hampir Habis (previously Riwayat Barang Keluar Terbaru) -->
  <div class="section-header">
    <h5><i class="fas fa-exclamation-triangle me-2"></i> Stok Hampir Habis</h5>
    <button class="btn btn-add-item" data-bs-toggle="modal" data-bs-target="#addOutgoingModal">
      <i class="fas fa-plus"></i> Tambah Baru
    </button>
  </div>
  
  <div class="row g-4">
    <div class="col-6 col-md-3">
      <div class="card card-custom position-relative">
        <span class="badge-stock badge-low">Stok Rendah: 5</span>
        <img src="/api/placeholder/120/120" alt="Snap Ring" class="item-image">
        <div class="card-body">
          <p class="item-code">4441059100</p>
          <p class="item-name">Snap Ring</p>
          <span class="item-stock stock-low">Stok: 5 unit</span>
          <div class="item-actions">
            <button class="btn-action btn-view" data-bs-toggle="modal" data-bs-target="#viewItemModal" data-item="4441059100">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editItemModal" data-item="4441059100">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteItemModal" data-item="4441059100">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card card-custom position-relative">
        <span class="badge-stock badge-low">Stok Rendah: 8</span>
        <img src="/api/placeholder/120/120" alt="Bearing" class="item-image">
        <div class="card-body">
          <p class="item-code">MX925242</p>
          <p class="item-name">Bearing</p>
          <span class="item-stock stock-low">Stok: 8 unit</span>
          <div class="item-actions">
            <button class="btn-action btn-view" data-bs-toggle="modal" data-bs-target="#viewItemModal" data-item="MX925242">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editItemModal" data-item="MX925242">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteItemModal" data-item="MX925242">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card card-custom position-relative">
        <span class="badge-stock badge-low">Stok Rendah: 10</span>
        <img src="/api/placeholder/120/120" alt="Drive Gear Set" class="item-image">
        <div class="card-body">
          <p class="item-code">1524911</p>
          <p class="item-name">Drive Gear Set</p>
          <span class="item-stock stock-low">Stok: 10 unit</span>
          <div class="item-actions">
            <button class="btn-action btn-view" data-bs-toggle="modal" data-bs-target="#viewItemModal" data-item="1524911">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editItemModal" data-item="1524911">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteItemModal" data-item="1524911">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card card-custom position-relative">
        <span class="badge-stock badge-low">Stok Rendah: 12</span>
        <img src="/api/placeholder/120/120" alt="Bearing" class="item-image">
        <div class="card-body">
          <p class="item-code">ME639065</p>
          <p class="item-name">Bearing</p>
          <span class="item-stock stock-low">Stok: 12 unit</span>
          <div class="item-actions">
            <button class="btn-action btn-view" data-bs-toggle="modal" data-bs-target="#viewItemModal" data-item="ME639065">
              <i class="fas fa-eye"></i>
            </button>
            <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editItemModal" data-item="ME639065">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteItemModal" data-item="ME639065">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Most Used Items -->
  <div class="section-header">
    <h5><i class="fas fa-star me-2"></i> Barang yang Sering Digunakan</h5>
    <button class="btn btn-print">
      <i class="fas fa-print"></i> Cetak Laporan
    </button>
  </div>
  
  <div class="row g-4">
    <div class="col-6 col-md-3">
      <div class="card card-custom position-relative">
        <span class="badge-stock badge-low">Stok Rendah: 5</span>
        <img src="/api/placeholder/120/120" alt="Snap Ring" class="item-image">
        <div class="card-body">
          <p class="item-code">4441059100</p>
          <p class="item-name">Snap Ring</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">Digunakan 85x bulan ini</small>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card card-custom position-relative">
        <span class="badge-stock badge-low">Stok Rendah: 8</span>
        <img src="/api/placeholder/120/120" alt="Bearing" class="item-image">
        <div class="card-body">
          <p class="item-code">MX925242</p>
          <p class="item-name">Bearing</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">Digunakan 75x bulan ini</small>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card card-custom">
        <img src="/api/placeholder/120/120" alt="Bearing" class="item-image">
        <div class="card-body">
          <p class="item-code">ME639065</p>
          <p class="item-name">Bearing</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">Digunakan 65x bulan ini</small>
        </div>
      </div>
    </div>
    
    <div class="col-6 col-md-3">
      <div class="card card-custom">
        <img src="/api/placeholder/120/120" alt="Drive Gear Set" class="item-image">
        <div class="card-body">
          <p class="item-code">1524911</p>
          <p class="item-name">Drive Gear Set</p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">Digunakan 60x bulan ini</small>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Modal for View Item -->
<div class="modal fade" id="viewItemModal" tabindex="-1" aria-labelledby="viewItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewItemModalLabel">Detail Barang</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <img src="/api/placeholder/300/300" alt="Item Image" class="img-fluid mb-3">
            <h4 class="item-code">4441059100</h4>
            <h3 class="item-name">Snap Ring</h3>
          </div>
          <div class="col-md-8">
            <table class="table table-striped">
              <tr>
                <th width="30%">Kode Barang</th>
                <td>4441059100</td>
              </tr>
              <tr>
                <th>Nama Barang</th>
                <td>Snap Ring</td>
              </tr>
              <tr>
                <th>Kategori</th>
                <td>Ring</td>
              </tr>
              <tr>
                <th>Stok Tersedia</th>
                <td>5 unit</td>
              </tr>
              <tr>
                <th>Lokasi Penyimpanan</th>
                <td>Rak A-12</td>
              </tr>
              <tr>
                <th>Supplier</th>
                <td>PT. Mitra Sejahtera</td>
              </tr>
              <tr>
                <th>Deskripsi</th>
                <td>Snap ring untuk mesin industri dengan diameter 10mm</td>
              </tr>
              <tr>
                <th>Terakhir Diupdate</th>
                <td>15 Mei 2025</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Add Outgoing Item -->
<div class="modal fade" id="addOutgoingModal" tabindex="-1" aria-labelledby="addOutgoingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addOutgoingModalLabel">Tambah Barang Keluar</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="itemCode" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="itemCode" placeholder="Masukkan kode barang">
          </div>
          <div class="mb-3">
            <label for="itemName" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="itemName" placeholder="Nama barang akan terisi otomatis" readonly>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" placeholder="Masukkan jumlah">
          </div>
          <div class="mb-3">
            <label for="destination" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="destination" placeholder="Masukkan tujuan pengiriman">
          </div>
          <div class="mb-3">
            <label for="notes" class="form-label">Catatan</label>
            <textarea class="form-control" id="notes" rows="3" placeholder="Tambahkan catatan jika perlu"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Update current date
  function updateCurrentDate() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);
  }
  
  // Initialize date and other scripts
  document.addEventListener('DOMContentLoaded', function() {
    updateCurrentDate();
    
    // Update date every minute (in case page stays open)
    setInterval(updateCurrentDate, 60000);
    
    // Add animation to cards when they come into view
    const cards = document.querySelectorAll('.card-custom');
    cards.forEach((card, index) => {
      card.style.animationDelay = `${index * 0.1}s`;
      card.classList.add('fade-in');
    });
  });
</script>

</body>
</html>