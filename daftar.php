<?php
// KONEKSI & CEK LOGIN
session_start();
require 'config/koneksi.php';

// Cek status login
if (!isset($_SESSION['login'])) {
    header("Location: ../pages/login.php");
    exit;
}

// AMBIL DATA BARANG
$query = "SELECT * FROM barang ORDER BY created_at DESC";
$result = $conn->query($query);

// Handle error query
if ($result === false) {
    die("Gagal mengambil data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dizamatra Powerindo - Daftar Barang</title>
  <!-- Link Exsternal -->
    <!-- Bootstrap -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Googleapis -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Qr Code dari html 5 -->
      <script src="assets/scanner/html5-qrcode.min.js" type="text/javascript"></script>
    <!-- Sweetalert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- css -->
    <style>
      /* ================== VARIABEL ================== */
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
      /* ================== DASAR ================== */
        body {
          background: linear-gradient(135deg, var(--background) 0%, #e4eaef 100%);
          font-family: 'Poppins', sans-serif;
          transition: all 0.3s ease;
          overflow-x: hidden;
          padding-top: 70px;
          padding-left: 80px;
          color: var(--text-color);
        }
      /* ================== Header ================== */
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

        .header-actions {
          display: flex;
          align-items: center;
        }
      
        .date-display {
          margin-right: 15px;
          font-weight: 500;
          color: var(--primary-color);
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

      /* ================== Sidebar ================== */
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

      /* ================== Menu Utama ================== */
        main {
          padding: 20px;
          transition: all 0.3s ease;
        }
        /* Judul Atas */
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
          /* Search btn */
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
          /* Action btn */
            .action-buttons {
              display: flex;
              gap: 12px;
            }

            .btn-scan {
              background:#005AFF;
              color: white;
            }
            .btn-add-new {
              background:rgb(22, 176, 237);
              color: black;
            }

            .btn-add-new, .btn-scan {
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
            }

            .btn-add-new i, .btn-scan i {
              font-size: 16px;
              transform: scale(1);
              transition: transform 0.3s ease;
            }

            .btn-add-new::before, .btn-scan::before {
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

            .btn-add-new:hover, .btn-scan:hover {
              transform: translateY(-3px);
              box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
              color: white;
            }

            .btn-add-new:hover::before, .btn-scan:hover::before {
              opacity: 0.8;
            }

            .btn-add-new:hover i, .btn-scan:hover i {
              transform: scale(1.2);
            }
        
        /* Filter */
          .btn-filter {
            background-color: white;
            color: var(--text-color);
            border: 1px solid #dce4e8;
            font-weight: 500;
            padding: 8px 15px;
          }

          .btn-filter:hover, .btn-filter.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
          }
      
        /* Tabel */
          .table-container {
            position: relative;
            overflow: auto;
            max-height: 600px; /* Atur tinggi maksimal sesuai kebutuhan */
          }
          .table-container table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
          }

          .table-container thead th {
            position: sticky;
            top: 0;
            background-color: var(--accent-light);
            z-index: 10;
          }

          /* Untuk efek shadow saat scroll */
          .table-container thead {
            box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
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
      
          .badge {
            padding: 6px 10px;
            font-weight: 500;
            border-radius: 8px;
          }
          

          .qr-code {
            width: 50px;
            height: 50px;
            cursor: pointer;
            transition: transform 0.3s;
          }
          
          .qr-code:hover {
            transform: scale(1.5);
          }

          .stock-indicator {
            width: 100%;
            height: 5px;
            background: #e9ecef;
            border-radius: 3px;
            margin-top: 5px;
            overflow: hidden;
          }
          
          .stock-progress {
            height: 100%;
            background-color: var(--secondary-color);
            transition: width 0.5s ease;
          }
          
          .badge-stok {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 8px;
          }
          
          .badge-low {
            background-color: #fff3cd;
            color: #856404;
          }
          
          .badge-normal {
            background-color: #d4edda;
            color: #155724;
          }
          
          .badge-over {
            background-color: #f8d7da;
            color: #721c24;
          }
    
        /* Modal Scaner Pop Up */
          .scanner-container {
            position: relative;
            background: #000;
            border-radius: 8px;
            overflow: hidden;
          }

          /* Scanner Overlay */
          .scanner-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            height: 60%;
            pointer-events: none;
          }

          /* Corner Design */
          .corner {
            position: absolute;
            width: 25px;
            height: 25px;
            border-color: #00ff00;
            border-width: 3px;
          }

          .top-left { 
            top: 15px;
            left: 15px;
            border-top: solid;
            border-left: solid;
          }
          .top-right { 
            top: 15px;
            right: 15px;
            border-top: solid;
            border-right: solid;
          }
          .bottom-left { 
            bottom: 15px;
            left: 15px;
            border-bottom: solid;
            border-left: solid;
          }
          .bottom-right { 
            bottom: 15px;
            right: 15px;
            border-bottom: solid;
            border-right: solid;
          }

          /* Laser Animation */
          .laser {
            width: 100%;
            height: 2px;
            background: #ff3333;
            position: absolute;
            top: 20%;
            animation: laser 2s infinite;
            box-shadow: 0 0 8px rgba(255, 51, 51, 0.5);
          }

          @keyframes laser {
            0% { top: 20%; }
            50% { top: 80%; }
            100% { top: 20%; }
          }

          /* Upload Container */
          .upload-container {
            background: #f8f9fa;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
          }

          .preview-box {
            background: white;
            border-radius: 6px;
            height: 150px;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
          }

          .permission-modal .modal-content {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
          }
          
          .permission-modal .modal-header {
            background: linear-gradient(45deg, #2196F3, #1976D2);
            color: white;
            border-bottom: none;
            padding: 20px;
            position: relative;
          }
          
          .permission-modal .modal-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: rgba(255,255,255,0.5);
          }
          
          .permission-modal .modal-body {
            padding: 25px;
            text-align: center;
            background: #f8f9fa;
          }
          
          .permission-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
          }
          
          .btn-permission {
            min-width: 120px;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
          }
          
          #allowCamera {
            background: #4CAF50;
            border-color: #4CAF50;
          }
          
          #denyCamera {
            background: #f44336;
            border-color: #f44336;
          }
          
          .btn-permission:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
          }
          
          .btn-permission i {
            font-size: 18px;
            margin-right: 8px;
          }
      
        /* Modal Add Pop Up */
          .modal-add .modal-content {
                    border: none;
                    border-radius: 18px;
                    overflow: hidden;
                    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                  }

                  .modal-add .modal-header {
                    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                    border-bottom: none;
                    padding: 20px 25px;
                  }

                  .modal-add .modal-title {
                    font-weight: 600;
                    font-size: 1.25rem;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                  }

                  .modal-add .modal-body {
                    padding: 25px;
                    background-color: #f8f9fa;
                  }

                  .form-floating {
                    margin-bottom: 20px;
                  }

                  .form-floating > .form-control {
                    padding: 1.5rem 0.75rem 0.75rem;
                    height: calc(3.5rem + 2px);
                    line-height: 1.25;
                    border-radius: 10px;
                    border: 1px solid #dce4e8;
                    transition: all 0.3s ease;
                  }

                  .form-floating > .form-control:focus {
                    border-color: var(--primary-color);
                    box-shadow: 0 0 0 3px rgba(27, 94, 32, 0.15);
                  }

                  .form-floating > label {
                    padding: 1rem 0.75rem;
                    color: var(--light-text);
                  }

                  /* Form separator */
                  .form-section-divider {
                    display: flex;
                    align-items: center;
                    margin: 25px 0 15px;
                  }

                  .form-section-divider span {
                    padding: 0 15px;
                    font-weight: 600;
                    color: var(--primary-color);
                  }

                  .form-section-divider:before,
                  .form-section-divider:after {
                    content: "";
                    flex: 1;
                    border-bottom: 1px solid #dce4e8;
                  }

                  /* Image upload styling */
                  .image-upload-container {
                    background-color: white;
                    border-radius: 10px;
                    padding: 20px;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                  }

                  .image-upload-tabs .nav-link {
                    color: var(--light-text);
                    border: none;
                    padding: 8px 15px;
                    border-radius: 8px;
                    font-weight: 500;
                    transition: all 0.2s ease;
                  }

                  .image-upload-tabs .nav-link:hover {
                    background-color: #f0f0f0;
                  }

                  .image-upload-tabs .nav-link.active {
                    background-color: var(--accent-light);
                    color: var(--primary-color);
                    font-weight: 600;
                  }

                  .image-upload-tab-content {
                    padding: 15px 0;
                  }

                  .image-preview-container {
                    margin-top: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 150px;
                    background-color: #f8f9fa;
                    border: 2px dashed #dce4e8;
                    border-radius: 8px;
                    padding: 15px;
                    position: relative;
                    overflow: hidden;
                    transition: all 0.3s ease;
                  }

                  .image-preview-container.has-image {
                    border-style: solid;
                    border-color: var(--secondary-color);
                    background-color: white;
                  }

                  .image-preview-placeholder {
                    color: var(--light-text);
                    text-align: center;
                    padding: 20px;
                  }

                  .image-preview-placeholder i {
                    font-size: 48px;
                    margin-bottom: 10px;
                    opacity: 0.5;
                  }

                  #imagePreview {
                    max-width: 100%;
                    max-height: 150px;
                    object-fit: contain;
                    border-radius: 4px;
                    transition: all 0.3s ease;
                  }

                  /* Input validation styling */
                  .is-invalid {
                    border-color: #dc3545 !important;
                    padding-right: calc(1.5em + 0.75rem);
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
                    background-repeat: no-repeat;
                    background-position: right calc(0.375em + 0.1875rem) center;
                    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
                  }

                  .is-valid {
                    border-color: #198754 !important;
                    padding-right: calc(1.5em + 0.75rem);
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
                    background-repeat: no-repeat;
                    background-position: right calc(0.375em + 0.1875rem) center;
                    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
                  }

                  .invalid-feedback {
                    display: none;
                    width: 100%;
                    margin-top: 0.25rem;
                    font-size: 0.875em;
                    color: #dc3545;
                  }

                  .valid-feedback {
                    display: none;
                    width: 100%;
                    margin-top: 0.25rem;
                    font-size: 0.875em;
                    color: #198754;
                  }

                  .was-validated .form-control:invalid ~ .invalid-feedback,
                  .form-control.is-invalid ~ .invalid-feedback,
                  .was-validated .form-control:valid ~ .valid-feedback,
                  .form-control.is-valid ~ .valid-feedback {
                    display: block;
                  }

                  /* Modal footer */
                  .modal-add .modal-footer {
                    padding: 15px 25px;
                    border-top: 1px solid #f0f0f0;
                  }

                  .modal-add .btn-primary {
                    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                    border: none;
                    border-radius: 50px;
                    padding: 10px 25px;
                    font-weight: 500;
                    box-shadow: 0 4px 12px rgba(27, 94, 32, 0.25);
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                  }

                  .modal-add .btn-primary:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 15px rgba(27, 94, 32, 0.35);
                  }

                  .modal-add .btn-secondary {
                    background-color: #e0e0e0;
                    color: #424242;
                    border: none;
                    border-radius: 50px;
                    padding: 10px 25px;
                    font-weight: 500;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                  }

                  .modal-add .btn-secondary:hover {
                    background-color: #bdbdbd;
                  }

      /* ================== Responisve ================== */
        @media (max-width: 768px) {
          body {
            padding-left: 0;
            padding-bottom: 60px;
          }

          /* Sidebar */
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

        /* Menu Utama */
          main {
            padding-top: 9px; /* 70px (header) + 50px (section-title) + 40px (btn-group) */
          }
          .section-title {
            position: -webkit-sticky; /* Untuk Safari/iOS */
            position: sticky;
            top: 70px; /* Harus sama dengan tinggi header */
            z-index: 1000; /* Pastikan lebih tinggi dari elemen lain */
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            padding: 9px 7px;
            margin: 0;
            width: 100%;
            box-sizing: border-box;
            gap: 3px;
            /* Fix untuk iOS & performa scroll */
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translate3d(0, 0, 0); /* Aktifkan GPU acceleration */
            will-change: transform;
            
            /* Scroll halus di mobile */
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            white-space: nowrap;
          }
              
            
              .section-title h4 {
                display: none; /* Sembunyikan judul saat di mobile */
              }
            /* Filter */
            .btn-group {
              position: -webkit-sticky;
              position: sticky;
              top: 120px; /* 70px (header) + 50px (section-title) */
              z-index: 1001; /* Lebih rendah dari section-title */
              background: white;
              padding: 10px 15px;
              margin: 0 0 5px 0 !important;
              width: 100%;
              box-sizing: border-box;
              overflow-x: auto;
              white-space: nowrap;
              -webkit-overflow-scrolling: touch;
              box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
                .btn-filter {
                  flex: 0 0 auto;
                  padding: 6px 12px;
                  font-size: 13px;
                }
                
            }
    </style>
</head>

<body>
  <!-- Header -->
    <header>
    <img src="../assets/image/logodz.png" alt="Logo Dizamatra Powerindo" class="logo">
      <div class="header-actions">
        <span class="date-display" id="current-date"></span>
        <div>
        <a href="config/logout.php" class="btn btn-danger logout-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
        </div>
      </div>
    </header>
  <!-- Sidebar -->
    <div class="sidebar">
      <a href="home.php" class="sidebar-item">
        <div class="sidebar-icon"><i class="fas fa-home"></i></div>
        <span class="sidebar-text">Home</span>
      </a>
      <a href="daftar.php" class="sidebar-item active">
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

  <!-- Menu Utama -->
    <main class="container-fluid">
    <!-- Judul Atas -->
      <div class="section-title">
        <h4><i class="fas fa-boxes me-2"></i> Daftar Barang</h4>

        <div class="search-container">
          <div class="search-input-group me-2">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari barang...">
            <button class="search-button" id="searchBtn">
            <i class="fas fa-arrow-right"></i>
          </button>
          </div>
        </div>

        <div class="action-buttons">
          <button class="btn-scan" data-bs-toggle="modal" data-bs-target="#scanModal">
            <i class="fas fa-qrcode"></i>
          </button>
          <button class="btn-add-new" data-bs-toggle="modal" data-bs-target="#addItemModal">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>

    <!-- Filter -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-filter active" data-filter="semua">Semua</button>
            <button type="button" class="btn btn-filter" data-filter="keluar">Keluar</button>
            <button type="button" class="btn btn-filter" data-filter="masuk">Masuk</button>
          </div>
        </div>

    <!-- Tabel Semua Barang -->
      <div class="table-container" id="semua">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>QR Code</th>
              <th>Part Number</th>
              <th>Nama Barang</th>
              <th>Merk</th>
              <th>Unit Kendaraan</th>
              <th>Satuan</th>
              <th>Stok</th>
              <th>Min</th>
              <th>Max</th>
              <th>Status</th>
              <th>Terakhir Update</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
          <?php if ($result->num_rows > 0) : ?>
              <?php 
              $no = 1; // Inisialisasi nomor urut
              while($row = $result->fetch_assoc()) : 
                // Logika penentuan status stok
                $persentase = ($row['stok'] / $row['stok_max']) * 100;
                $persentase = min($persentase, 100);
                
                if($row['stok'] < $row['stok_min']) {
                    $status = 'Rendah';
                    $badge_class = 'badge-low';
                } elseif($row['stok'] > $row['stok_max']) {
                    $status = 'Berlebih';
                    $badge_class = 'badge-over';
                } else {
                    $status = 'Normal';
                    $badge_class = 'badge-normal';
                }
              ?>
              <tr>
                <td><?= $no++ ?></td> <!-- Nomor urut otomatis -->
                <td>
                  <img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=<?= $row['part_number'] ?>" 
                      class="qr-code" 
                      alt="QR Code <?= htmlspecialchars($row['nama_barang']) ?>">
                </td>
                <td><?= htmlspecialchars($row['part_number']) ?></td>
                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                <td><?= htmlspecialchars($row['merk'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['unit_kendaraan']) ?></td>
                <td><?= htmlspecialchars($row['satuan']) ?></td>
                <td>
                  <?= $row['stok'] ?>
                  <div class="stock-indicator">
                    <div class="stock-progress" 
                        style="width: <?= $persentase ?>%; background-color: <?= $progress_color ?>">
                    </div>
                  </div>
                </td>
                <td><?= $row['stok_min'] ?></td>
                <td><?= $row['stok_max'] ?></td>
                <td><span class="badge <?= $badge_class ?>"><?= $status ?></span></td>
                <td><?= date('d M Y H:i', strtotime($row['updated_at'])) ?></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="13" class="text-center py-4 text-muted">
                  <i class="fas fa-box-open fa-2x mb-3"></i>
                  <p>Tidak ada data barang</p>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    <!-- Daftar Barang Keluar -->
      <div class="table-container d-none" id="keluar">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>QR Code</th>
              <th>Part Number</th>
              <th>Nama Barang</th>
              <th>Penerima</th>
              <th>Jumlah</th>
              <th>Tanggal Keluar</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=ITEM001" class="qr-code"></td>
              <td>ITEM001</td>
              <td>Power Inverter 1000W</td>
              <td>PT Elektro Makmur</td>
              <td>5</td>
              <td>10 Mar 2024</td>
              <td>
                <button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-file"></i></button>
                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-undo"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    <!-- Daftar Barang Masuk -->
      <div class="table-container d-none" id="masuk">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>QR Code</th>
              <th>Part Number</th>
              <th>Nama Barang</th>
              <th>Supplier</th>
              <th>Jumlah</th>
              <th>Tanggal Masuk</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=ITEM005" class="qr-code"></td>
              <td>ITEM005</td>
              <td>Kabel Solar 6mm</td>
              <td>CV Kabel Sejahtera</td>
              <td>50</td>
              <td>5 Mar 2024</td>
              <td>
                <button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-file"></i></button>
                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-undo"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>

  <!-- Modal Scanner -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white py-3">
            <h5 class="modal-title mb-0">
              <i class="fas fa-camera me-2"></i>Scan/Upload QR Code
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          
          <div class="modal-body p-2">
            <!-- Tabs Scan/Upload -->
            <ul class="nav nav-tabs mb-3" id="scanTabs">
              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#scanLive">
                  <i class="fas fa-camera me-1"></i>Live Scan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#scanUpload">
                  <i class="fas fa-upload me-1"></i>Upload File
                </a>
              </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
              <!-- Live Scan Tab -->
              <div class="tab-pane fade show active" id="scanLive">
                <div class="scanner-container" style="height: 250px">
                  <div id="reader" class="scanner-viewport"></div>
                  <div class="scanner-overlay">
                    <div class="corner top-left"></div>
                    <div class="corner top-right"></div>
                    <div class="corner bottom-left"></div>
                    <div class="corner bottom-right"></div>
                    <div class="laser"></div>
                  </div>
                </div>
              </div>

              <!-- Upload Tab -->
              <div class="tab-pane fade" id="scanUpload">
                <div class="upload-container text-center p-4 border rounded">
                  <input type="file" id="qrUpload" accept="image/*" hidden>
                  <label for="qrUpload" class="btn btn-outline-primary mb-3">
                    <i class="fas fa-folder-open me-2"></i>Pilih File
                  </label>
                  <div id="uploadPreview" class="preview-box mt-3"></div>
                </div>
              </div>
            </div>

            <!-- Scan Result -->
            <div class="scan-result mt-3">
              <div class="alert alert-success py-2 px-3 mb-0 d-flex align-items-center fade">
                <i class="fas fa-check-circle me-2"></i>
                <span class="result-text flex-grow-1"></span>
                <button class="btn btn-sm btn-success btn-copy ms-2">
                  <i class="fas fa-copy"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="modal-footer py-2">
            <button class="btn btn-sm btn-outline-secondary btn-switch-camera me-auto">
              <i class="fas fa-camera-rotate"></i>
            </button>
            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
              <i class="fas fa-times me-2"></i>Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Izin Kamera -->
      <div class="modal fade permission-modal" id="cameraPermissionModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <i class="fas fa-camera me-2"></i>Akses Kamera Diperlukan
            </h5>
          </div>
          <div class="modal-body">
            <div class="permission-icon animate__animated animate__bounceIn">
              <i class="fas fa-video fa-3x text-primary mb-4"></i>
            </div>
            <h5 class="mb-3">Izinkan akses kamera?</h5>
            <p class="text-muted">Kami membutuhkan akses kamera untuk memindai QR Code</p>
            
            <div class="permission-buttons">
              <button type="button" class="btn btn-success btn-permission" id="allowCamera">
                <i class="fas fa-check"></i>Izinkan
              </button>
              <button type="button" class="btn btn-danger btn-permission" id="denyCamera">
                <i class="fas fa-times"></i>Tolak
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  <!-- Modal Tambah Barang -->
    <div class="modal fade modal-add" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Header Modal -->
          <div class="modal-header">
            <h5 class="modal-title" id="addItemModalLabel">
              <i class="fas fa-box-open me-2"></i>Tambah Barang Baru
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <!-- Form Input -->
          <form action="../api/proses_tambah_barang.php" method="POST" enctype="multipart/form-data" id="formAddItem" novalidate>
            <div class="modal-body">
              <!-- Informasi Barang -->
              <div class="form-section-divider">
                <span><i class="fas fa-info-circle me-2"></i>Informasi Barang</span>
              </div>
              
              <div class="row g-3">
                <!-- Kolom Input Kiri -->
                <div class="col-md-6">
                  <!-- Input Part Number -->
                  <div class="form-floating mb-3">
                    <input type="text" 
                          class="form-control <?= isset($_SESSION['error_part_number']) ? 'is-invalid' : '' ?>" 
                          id="partNumber" 
                          name="part_number" 
                          required
                          pattern="[A-Z0-9-]{3,20}"
                          title="Minimal 3 karakter (huruf kapital, angka, atau dash)">
                    <label for="partNumber">Part Number</label>
                    <div class="invalid-feedback" id="partNumberFeedback">
                      <?= $_SESSION['error_part_number'] ?? 'Masukkan part number yang valid' ?>
                    </div>
                    <div class="valid-feedback">
                      Part number tersedia
                    </div>
                  </div>

                  <!-- Input Nama Barang -->
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="namaBarang" name="nama_barang" required>
                    <label for="namaBarang">Nama Barang</label>
                    <div class="invalid-feedback">
                      Masukkan nama barang
                    </div>
                  </div>

                  <!-- Input Merk -->
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="merk" name="merk">
                    <label for="merk">Merek</label>
                  </div>
                </div>

                <!-- Kolom Input Kanan -->
                <div class="col-md-6">
                  <!-- Input Unit Kendaraan -->
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="unitKendaraan" name="unit_kendaraan" required>
                    <label for="unitKendaraan">Unit Kendaraan</label>
                    <div class="invalid-feedback">
                      Masukkan unit kendaraan
                    </div>
                  </div>
                  
                  <!-- Pilihan Satuan -->
                  <div class="form-floating mb-3">
                    <select class="form-select" id="satuan" name="satuan" required>
                      <option value="" disabled selected>Pilih satuan</option>
                      <option value="PCS">PCS</option>
                      <option value="SET">SET</option>
                      <option value="UNIT">UNIT</option>
                      <option value="METER">METER</option>
                    </select>
                    <label for="satuan">Satuan Barang</label>
                    <div class="invalid-feedback">
                      Pilih satuan barang
                    </div>
                  </div>
                </div>
              </div>

              <!-- Stok & Gambar -->
              <div class="form-section-divider">
                <span><i class="fas fa-cubes me-2"></i>Informasi Stok</span>
              </div>

              <div class="row g-3">
                <div class="col-md-4">
                  <!-- Input Stok Awal -->
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stokAwal" 
                          name="stok_awal" min="0" value="0" required>
                    <label for="stokAwal">Stok Awal</label>
                    <div class="invalid-feedback">
                      Masukkan stok awal (minimal 0)
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- Input Stok Minimum -->
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stokMin" 
                          name="stok_min" min="0" required>
                    <label for="stokMin">Stok Minimum</label>
                    <div class="invalid-feedback">
                      Masukkan stok minimum
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- Input Stok Maksimum -->
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stokMax" 
                          name="stok_max" min="1" required>
                    <label for="stokMax">Stok Maksimum</label>
                    <div class="invalid-feedback">
                      Masukkan stok maksimum
                    </div>
                  </div>
                </div>
              </div>

              <!-- Gambar Barang -->
              <div class="form-section-divider">
                <span><i class="fas fa-image me-2"></i>Gambar Barang</span>
              </div>

              <div class="image-upload-container">
                <!-- Navigasi Tab Gambar -->
                <ul class="nav nav-tabs image-upload-tabs" id="gambarTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="upload-tab" data-bs-toggle="tab" 
                            data-bs-target="#upload" type="button" role="tab">
                            <i class="fas fa-upload me-2"></i>Upload File
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="url-tab" data-bs-toggle="tab" 
                            data-bs-target="#url" type="button" role="tab">
                            <i class="fas fa-link me-2"></i>URL
                    </button>
                  </li>
                </ul>

                <!-- Konten Tab Gambar -->
                <div class="tab-content image-upload-tab-content" id="myTabContent">
                  <!-- Tab Upload File -->
                  <div class="tab-pane fade show active" id="upload" role="tabpanel">
                    <div class="input-group">
                      <input type="file" class="form-control" id="gambarUpload" name="gambar_upload" 
                            accept="image/*">
                      <label class="input-group-text" for="gambarUpload">
                        <i class="fas fa-file-image"></i>
                      </label>
                    </div>
                  </div>
                  
                  <!-- Tab URL -->
                  <div class="tab-pane fade" id="url" role="tabpanel">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                      <input type="url" class="form-control" id="gambarUrl" name="gambar_url" 
                            placeholder="https://example.com/gambar.jpg">
                    </div>
                  </div>
                </div>

                <!-- Preview Gambar -->
                <div class="image-preview-container" id="imagePreviewContainer">
                  <div class="image-preview-placeholder" id="previewPlaceholder">
                    <i class="fas fa-image"></i>
                    <p>Pratinjau gambar akan ditampilkan di sini</p>
                  </div>
                  <img id="imagePreview" src="#" alt="Pratinjau Gambar" class="d-none">
                </div>
              </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times me-2"></i>Batal
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Simpan Barang
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
<!-- Semua Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Update Tanggal
      function updateCurrentDate() {
        const options = { 
          weekday: 'long', 
          year: 'numeric', 
          month: 'long', 
          day: 'numeric' 
        };
        document.getElementById('current-date').textContent = 
          new Date().toLocaleDateString('id-ID', options);
      }
      
      updateCurrentDate();
      setInterval(updateCurrentDate, 60000);

      // 2. Filter & Pencarian
      function filterHandler(filterType) {
        document.querySelectorAll('[data-filter]').forEach(btn => 
          btn.classList.toggle('active', btn.dataset.filter === filterType));
        
        document.querySelectorAll('.table-container').forEach(table => 
          table.classList.toggle('d-none', table.id !== filterType));
      }

      document.querySelectorAll('[data-filter]').forEach(button => {
        button.addEventListener('click', () => filterHandler(button.dataset.filter));
      });

      document.getElementById('searchInput').addEventListener('input', function() {
        const term = this.value.toLowerCase();
        const activeTable = document.querySelector('.table-container:not(.d-none)');
        
        activeTable.querySelectorAll('tbody tr').forEach(row => {
          row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
        });
      });

      filterHandler('semua');

      // 3. QR Code Scanner
        const scanModal = new bootstrap.Modal('#scanModal');
        const cameraPermissionModal = new bootstrap.Modal('#cameraPermissionModal');
        let qrScanner = null;
        let isScanning = false;

        // Handle tombol scan
        document.querySelector('.btn-scan').addEventListener('click', async (e) => {
          e.preventDefault();
          try {
            const permission = await checkCameraPermission();
            
            if(permission === 'granted') {
              initScanner();
              scanModal.show();
            } else {
              cameraPermissionModal.show();
            }
          } catch (error) {
            console.error('Error:', error);
            showErrorAlert('Gagal mengakses kamera');
          }
        });

        // Handle izinkan kamera
        document.getElementById('allowCamera').addEventListener('click', async () => {
          try {
            const stream = await requestCameraAccess();
            if(stream) {
              cameraPermissionModal.hide();
              initScanner();
              scanModal.show();
            }
          } catch (error) {
            showPermissionError();
          }
        });

        // Handle tolak kamera
        document.getElementById('denyCamera').addEventListener('click', () => {
          cameraPermissionModal.hide();
          Swal.fire({
            icon: 'info',
            title: 'Izin Ditolak',
            text: 'Anda bisa mengaktifkan kamera nanti melalui pengaturan',
            timer: 2000
          });
        });

        // Fungsi cek izin kamera
          async function checkCameraPermission() {
            try {
              const devices = await navigator.mediaDevices.enumerateDevices();
              const hasCameraAccess = devices.some(device => device.kind === 'videoinput' && device.label !== '');
              return hasCameraAccess ? 'granted' : 'prompt';
            } catch {
              return 'prompt';
            }
          }

        // Minta akses kamera
        async function requestCameraAccess() {
          try {
            return await navigator.mediaDevices.getUserMedia({ video: true });
          } catch (error) {
            throw error;
          }
        }

        // Inisialisasi scanner
        function initScanner() {
          if(qrScanner) return;
          
          qrScanner = new Html5QrcodeScanner(
            'reader',
            {
              fps: 10,
              qrbox: 250,
              rememberLastUsedCamera: true,
              facingMode: "environment"
            },
            /* verbose= */ false
          );

          qrScanner.render(
            (decodedText) => handleScanResult(decodedText),
            (error) => {
              console.error('Scanner error:', error);
              if(error.includes('Permission denied')) {
                showPermissionError();
                scanModal.hide();
              }
            }
          );
        }

        // Handle hasil scan
        function handleScanResult(decodedText) {
          Swal.fire({
            title: 'Berhasil!',
            html: `<strong>Kode Terdeteksi:</strong><br>${decodedText}`,
            icon: 'success'
          }).then(() => {
            scanModal.hide();
            window.location.href = `detail.php?pn=${decodedText}`;
          });
        }

        // Tampilkan error
        function showPermissionError() {
          Swal.fire({
            icon: 'error',
            title: 'Akses Kamera Ditolak',
            html: `Anda perlu mengizinkan akses kamera melalui popup browser<br>
              <button class="btn btn-link mt-2" onclick="showHelpGuide()">
                <i class="fas fa-question-circle"></i> Panduan
              </button>`
          });
        }

        // Panduan pengaturan
        window.showHelpGuide = function() {
          Swal.fire({
            title: 'Panduan Aktifkan Kamera',
            html: `
              <div class="text-start">
                <div class="mb-4">
                  <h6><i class="fab fa-android me-2"></i>Untuk Android:</h6>
                  <ol>
                    <li>Buka Pengaturan Aplikasi</li>
                    <li>Pilih Browser yang digunakan</li>
                    <li>Pilih "Izin"</li>
                    <li>Aktifkan "Kamera"</li>
                  </ol>
                </div>
                
                <div>
                  <h6><i class="fab fa-apple me-2"></i>Untuk iOS:</h6>
                  <ol>
                    <li>Buka Pengaturan > Safari</li>
                    <li>Pilih "Pengaturan Situs Web"</li>
                    <li>Pilih "Kamera"</li>
                    <li>Cari situs ini dan pilih "Izinkan"</li>
                  </ol>
                </div>
              </div>
            `,
            confirmButtonText: 'Mengerti'
          });
        }

         // Cleanup scanner
          scanModal._element.addEventListener('hidden.bs.modal', () => {
            if(qrScanner && isScanning) {
              qrScanner.clear().catch(console.error);
              qrScanner = null;
              isScanning = false;
            }
          });



      // 4. Gambar
      const addItemModal = document.getElementById('addItemModal');
      
      if (addItemModal) {
        // Handle upload file
        document.querySelector('input[name="gambar_upload"]').addEventListener('change', function(e) {
          if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = (event) => showPreview(event.target.result);
            reader.readAsDataURL(e.target.files[0]);
          }
        });

        // Handle URL gambar
        document.querySelector('input[name="gambar_url"]').addEventListener('input', function() {
          if (this.value) showPreview(this.value);
        });
      }

      // 5. Validasi Part Number
      const partNumberInput = document.getElementById('partNumber');
      
      if (partNumberInput) {
        partNumberInput.addEventListener('blur', function() {
          const partNumber = this.value.trim();
          const feedback = document.getElementById('partNumberFeedback');
          
          if(partNumber.length < 3) return;
          
          fetch(`config/check_partnumber.php?part_number=${encodeURIComponent(partNumber)}`)
            .then(response => response.json())
            .then(data => {
              if(data.exists) {
                this.classList.add('is-invalid');
                feedback.textContent = `⚠️ Part number "${data.part_number}" sudah terdaftar!`;
              } else {
                this.classList.remove('is-invalid');
                feedback.textContent = '✅ Part number tersedia';
              }
            });
        });

        partNumberInput.addEventListener('input', function() {
          this.value = this.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
        });
      }

      // 6. Notifikasi dari PHP
      <?php if (isset($_SESSION['success'])): ?>
Swal.fire({
    title: '<?= $_SESSION['success']['title'] ?>',
    html: '<?= $_SESSION['success']['html'] ?>',
    icon: 'success',
    timer: <?= $_SESSION['success']['timer'] ?>,
    timerProgressBar: true,
    showConfirmButton: <?= $_SESSION['success']['confirmButton'] ? 'true' : 'false' ?>, // Tombol OK muncul
    confirmButtonColor: '#2e7d32',
    allowOutsideClick: false, // Tidak bisa ditutup dengan klik di luar
    customClass: {
        popup: 'rounded-4 shadow-lg',
        title: 'text-success'
    },
    didClose: () => {
        <?php unset($_SESSION['success']); ?> // Bersihkan session saat notifikasi ditutup
    }
});
<?php endif; ?>

      <?php if (isset($_SESSION['error'])): ?>
        Swal.fire({
          title: 'Error!',
          text: '<?= $_SESSION['error'] ?>',
          icon: 'error',
          confirmButtonColor: '#d32f2f'
        });
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>
    });

    function handleMobileScroll() {
    if (window.innerWidth <= 768) {
      const sectionTitle = document.querySelector('.section-title');
      const header = document.querySelector('header');
      const sidebar = document.querySelector('.sidebar');
      
      // Sesuaikan posisi sticky berdasarkan elemen yang ada
      if (sectionTitle && header) {
        const headerHeight = header.offsetHeight;
        sectionTitle.style.top = `${headerHeight}px`;
      }
      
      // Sesuaikan tinggi tabel container
      const tableContainers = document.querySelectorAll('.table-container');
      tableContainers.forEach(container => {
        const viewportHeight = window.innerHeight;
        const containerTop = container.getBoundingClientRect().top;
        const calculatedHeight = viewportHeight - containerTop - 20;
        container.style.maxHeight = `${calculatedHeight}px`;
      });
    }
  }
  
  // Panggil saat load dan resize
  handleMobileScroll();
  window.addEventListener('resize', handleMobileScroll);
  </script>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>