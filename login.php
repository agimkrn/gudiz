<?php 
  session_start();
  require 'config/koneksi.php';
  
  // Redirect jika sudah login, agar tidak mengakses halaman login jika sudah login
  if (isset($_SESSION['login'])) {
    header("Location: home.php");
    exit;
  }
  
  // Proses login ketika form login dikirim
  if (isset($_POST['login'])) {
    // Mengambil dan membersihkan data input pengguna
    $username = $conn->real_escape_string(trim($_POST['nama_pengguna']));
    $password = $conn->real_escape_string(trim($_POST['password']));
  
    // Mencari akun berdasarkan nama pengguna
    $query = "SELECT * FROM akun WHERE nama_pengguna = '$username'";
    $result = $conn->query($query);
  
    // Jika ditemukan satu akun dengan nama pengguna tersebut
    if ($result->num_rows === 1) {
      $akun = $result->fetch_assoc();
  
      // Memeriksa apakah kata sandi cocok dengan yang ada di database
      if ($password === $akun['sandi']) { // Ganti ke password_verify jika menggunakan hash
        // Jika login berhasil, simpan informasi pengguna di session
        $_SESSION['login'] = true;
        $_SESSION['id'] = $akun['id'];
        $_SESSION['nama'] = $akun['nama_lengkap'];
        $_SESSION['level'] = $akun['level'];
  
        // Redirect ke halaman utama setelah login berhasil
        header("Location: home.php");
        exit;
      } else {
        // Jika kata sandi salah, beri pesan kesalahan
        $_SESSION['login_error'] = 'Kata sandi salah!';
      }
    } else {
      // Jika nama pengguna tidak ditemukan, beri pesan kesalahan
      $_SESSION['login_error'] = 'Nama pengguna tidak ditemukan!';
    }
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="color-scheme" content="light dark">
  <title>Dizamatra Powerindo - Login</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&display=swap" rel="stylesheet" />
  
  <!-- Animate.css untuk animasi -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <style>
    :root {
      /* Light mode variables */
      --primary-color: #2e7d32;
      --secondary-color: #4caf50;
      --accent-color: #c8e6c9;
      --text-color: #333333;
      --light-text: #6c757d;
      --bg-gradient-start: #f5f7fa;
      --bg-gradient-end: #e4eaef;
      --container-bg: #ffffff;
      --input-bg: #f8f9fa;
      --input-text: #333333;
      --input-border: #dce4e8;
      --shadow-color: rgba(0, 0, 0, 0.1);
      --btn-gradient-start: #2e7d32;
      --btn-gradient-end: #4caf50;
      --btn-hover-start: #1b5e20;
      --btn-hover-end: #2e7d32;
      --footer-color: #6c757d;
      --company-name-color: #333333;
    }

    @media (prefers-color-scheme: dark) {
      :root {
        /* Dark mode variables */
        --primary-color: #4caf50;
        --secondary-color: #81c784;
        --accent-color: #2e7d32;
        --text-color: #e0e0e0;
        --light-text: #b0bec5;
        --bg-gradient-start: #121212;
        --bg-gradient-end: #1a1a1a;
        --container-bg: #1e1e1e;
        --input-bg: #333333;
        --input-text: #ffffff;
        --input-border: #555555;
        --shadow-color: rgba(0, 0, 0, 0.3);
        --btn-gradient-start: #388e3c;
        --btn-gradient-end: #1b5e20;
        --btn-hover-start: #4caf50;
        --btn-hover-end: #388e3c;
        --footer-color: #757575;
        --company-name-color: #ffffff;
      }
    }

    * {
      font-family: 'Poppins', sans-serif;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
      color: var(--text-color);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      transition: background 0.3s ease, color 0.3s ease;
    }

    .login-container {
      background: var(--container-bg);
      padding: 2.5rem;
      border-radius: 20px;
      box-shadow: 0 15px 35px var(--shadow-color);
      max-width: 430px;
      width: 90%;
      position: relative;
      overflow: hidden;
      z-index: 1;
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .login-container::before,
    .login-container::after {
      content: "";
      position: absolute;
      background-color: var(--accent-color);
      border-radius: 50%;
      opacity: 0.5;
      z-index: 0;
      transition: background-color 0.3s ease;
    }

    .login-container::before {
      top: -50px;
      left: -50px;
      width: 150px;
      height: 150px;
    }

    .login-container::after {
      bottom: -50px;
      right: -50px;
      width: 120px;
      height: 120px;
    }

    .login-content {
      position: relative;
      z-index: 1;
    }

    .login-logo {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
    }

    .logo-image {
      height: 70px;
      filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.1));
      transition: transform 0.3s ease, filter 0.3s ease;
    }

    .company-name {
      margin-left: 15px;
      text-align: left;
      line-height: 1;
    }

    .company-name h1 {
      font-size: 1.35rem;
      font-weight: 700;
      color: var(--company-name-color);
      margin: 0;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      transition: color 0.3s ease;
    }

    @media (prefers-color-scheme: dark) {
      .logo-image {
        filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.25)) brightness(1.1);
      }
    }

    .logo-image:hover {
      transform: scale(1.05);
    }

    /* Animasi tulisan Selamat Datang */
    .welcome-text-container {
      text-align: center;
      margin-bottom: 2rem;
      overflow: hidden;
      height: 80px; /* Increased height to prevent cutting off */
      width: 100%; /* Ensure full width */
    }

    .welcome-text {
      display: inline-block;
      position: relative;
      color: var(--primary-color);
      font-weight: 700; /* Made font weight bolder */
      font-size: 2.1rem; /* Slightly reduced font size to fit better */
      text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.05);
      transition: color 0.3s ease;
      width: 100%; /* Ensure full width */
      padding: 0 10px; /* Add some padding on sides */
    }
    
    .welcome-letter {
      display: inline-block;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.6s forwards;
    }
    
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Removed the underline animation */

    .form-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .form-control {
      border-radius: 12px;
      padding: 12px 12px 12px 45px;
      border: 1px solid var(--input-border);
      font-size: 16px;
      transition: all 0.3s ease;
      background-color: var(--input-bg);
      color: var(--input-text);
    }

    .form-control::placeholder {
      color: var(--light-text);
      opacity: 0.7;
    }

    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);
      border-color: var(--primary-color);
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--light-text);
      transition: color 0.3s ease;
    }

    .form-control:focus + .input-icon {
      color: var(--primary-color);
    }

    .btn-login {
      width: 100%;
      border-radius: 12px;
      background: linear-gradient(to right, var(--btn-gradient-start), var(--btn-gradient-end));
      color: white;
      font-weight: 600;
      padding: 12px;
      font-size: 16px;
      box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
      transition: all 0.3s ease;
      border: none;
      margin-top: 1rem;
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% {
        box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
      }
      50% {
        box-shadow: 0 4px 20px rgba(76, 175, 80, 0.5);
      }
      100% {
        box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
      }
    }

    .btn-login:hover {
      background: linear-gradient(to right, var(--btn-hover-start), var(--btn-hover-end));
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(76, 175, 80, 0.4);
      animation: none;
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .login-footer {
      text-align: center;
      margin-top: 2rem;
      color: var(--footer-color);
      font-size: 14px;
      font-weight: 300;
      transition: color 0.3s ease;
    }

    @media (max-width: 576px) {
      .login-container {
        padding: 2rem;
        width: 95%;
      }
      
      .login-logo {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
      }
      
      .company-name {
        margin-left: 10px;
        text-align: left;
      }
      
      .logo-image {
        height: 50px;
      }
      
      .company-name h1 {
        font-size: 1.1rem;
      }
      
      .welcome-text {
        font-size: 1.8rem; /* Reduced font size for mobile but still visible */
      }
      
      .welcome-text-container {
        height: 65px; /* Adjusted height for mobile */
        padding: 0 5px;
      }
    }

    /* SweetAlert2 custom styles */
    .swal2-popup {
      font-family: 'Poppins', sans-serif;
    }

    @media (prefers-color-scheme: light) {
      .swal2-popup {
        background-color: #ffffff !important;
        color: #333333 !important;
      }

      .swal2-title {
        color: #333333 !important;
      }
    }

    @media (prefers-color-scheme: dark) {
      .swal2-popup {
        background-color: #333333 !important;
        color: #ffffff !important;
      }

      .swal2-title {
        color: #ffffff !important;
      }

      .swal2-html-container {
        color: #dddddd !important;
      }
    }

    .swal2-confirm {
      background-color: var(--primary-color) !important;
      color: white !important;
    }

    .swal2-cancel {
      background-color: #d32f2f !important;
      color: white !important;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-content">
      <div class="login-logo">
        <img src="asssets/image/logodz.png" alt="Logo Dizamatra Powerindo" class="logo-image" />
        <div class="company-name">
          <h1>DIZAMATRA</h1>
          <h1>POWERINDO</h1>
        </div>
      </div>

      <!-- Animasi Selamat Datang -->
      <div class="welcome-text-container">
        <h2 class="welcome-text"></h2>
      </div>

      <form method="POST">
        <div class="form-group">
          <input type="text" name="nama_pengguna" class="form-control" placeholder="Nama Pengguna" required />
          <i class="fas fa-user input-icon"></i>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required />
          <i class="fas fa-lock input-icon"></i>
        </div>
        <button type="submit" name="login" class="btn btn-login">
          <i class="fas fa-sign-in-alt me-2"></i> Masuk
        </button>
      </form>

      <div class="login-footer">
        <strong>Dizamatra Powerindo</strong> &copy; 2025
      </div>
    </div>
  </div>

  <script>
    // Fungsi animasi untuk tulisan SELAMAT DATANG
    function animateWelcomeText() {
      const welcomeText = document.querySelector('.welcome-text');
      
      // Kosongkan konten terlebih dahulu
      welcomeText.innerHTML = '';
      
      // Buat array dari karakter yang ingin ditampilkan, dengan spasi yang jelas
      const letters = ['S','E','L','A','M','A','T',' ','D','A','T','A','N','G'];
      
      // Tambahkan setiap huruf dengan delay
      letters.forEach((letter, index) => {
        const span = document.createElement('span');
        span.className = 'welcome-letter';
        span.textContent = letter;
        span.style.animationDelay = `${index * 0.1}s`;
        
        // Jika karakter adalah spasi, tambahkan style khusus untuk memastikan spasi terlihat
        if (letter === ' ') {
          span.style.width = '0.5em'; // Memastikan spasi memiliki lebar yang cukup
          span.style.display = 'inline-block'; // Memastikan lebar dipatuhi
        }
        
        welcomeText.appendChild(span);
      });
    }

    // Jalankan animasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', animateWelcomeText);

    // Menampilkan SweetAlert2 jika ada error login
    <?php if (isset($_SESSION['login_error'])): ?>
      Swal.fire({
        icon: 'error',
        timer : 5000,
        title: 'Coba Lagi',
        text: '<?php echo $_SESSION['login_error']; ?>',
      });
      <?php unset($_SESSION['login_error']); ?> 
    <?php endif; ?>

    // Mendeteksi perubahan preferensi tema sistem secara real-time
    const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

    // Event listener untuk mendeteksi perubahan tema sistem
    darkModeMediaQuery.addEventListener('change', (e) => {
      // Otomatis mengubah tema saat preferensi sistem berubah
      console.log("Preferensi tema berubah: " + (e.matches ? "dark" : "light"));
    });
  </script>

</body>
</html>