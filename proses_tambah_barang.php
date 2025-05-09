<?php
session_start();
require 'config/koneksi.php'; // Memastikan jalur ke koneksi.php benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $part_number = strtoupper(trim($_POST['part_number']));
    $nama_barang = htmlspecialchars(trim($_POST['nama_barang']));
    $merk = htmlspecialchars(trim($_POST['merk'] ?? ''));
    $unit_kendaraan = htmlspecialchars(trim($_POST['unit_kendaraan'] ?? ''));
    $satuan = $_POST['satuan'];
    $stok_min = (int)$_POST['stok_min'];
    $stok_max = (int)$_POST['stok_max'];
    $gambar = null;

    // Validasi part number (hanya huruf besar, angka, dan tanda hubung)
    if (!preg_match('/^[A-Z0-9-]{3,50}$/', $part_number)) {
        $_SESSION['error'] = 'Part number tidak valid!';
        header("Location: ../daftar.php");  
        exit;
    }

    // Cek duplikasi part number
    $check = $conn->prepare("SELECT part_number FROM barang WHERE part_number = ?");
    $check->bind_param("s", $part_number);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = 'Part number sudah ada dalam database!';
        header("Location: ../daftar.php");  
        exit;
    }

    // Handle upload gambar
    $upload_dir = '../uploads/'; // Direktori penyimpanan (pastikan jalurnya benar)
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Prioritas: 1. Upload file, 2. URL
    if (!empty($_FILES['gambar_upload']['name'])) {
        $file_name = basename($_FILES['gambar_upload']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Validasi ekstensi file (hanya gambar)
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        if (!in_array($file_ext, $allowed_extensions)) {
            $_SESSION['error'] = 'Format file tidak valid! Hanya .jpg, .jpeg, .png yang diizinkan.';
            header("Location: ../daftar.php"); 
            exit;
        }

        // Mengubah nama file
        $new_file_name = 'img_' . $part_number . '_' . time() . '.' . $file_ext;
        $target_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($_FILES['gambar_upload']['tmp_name'], $target_path)) {
            $gambar = $target_path;
        } else {
            $_SESSION['error'] = 'Gagal mengupload gambar!';
            header("Location: ../daftar.php");  
            exit;
        }
    } elseif (!empty($_POST['gambar_url'])) {
        // Handle URL gambar
        $url = filter_var($_POST['gambar_url'], FILTER_VALIDATE_URL);
        if ($url) {
            $gambar = $url;
        } else {
            $_SESSION['error'] = 'URL gambar tidak valid!';
            header("Location: ../daftar.php");  
            exit;
        }
    }

    try {
        // Menyisipkan data ke dalam database
        $stmt = $conn->prepare("INSERT INTO barang (
            part_number, nama_barang, merk, unit_kendaraan,
            satuan, stok_min, stok_max, gambar
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssiis",
            $part_number,
            $nama_barang,
            $merk,
            $unit_kendaraan,
            $satuan,
            $stok_min,
            $stok_max,
            $gambar
        );

        if ($stmt->execute()) {
            $_SESSION['success'] = [
                'title' => 'Berhasil!',
                'html' => "<strong>$nama_barang</strong> berhasil ditambahkan!",
                'timer' => 8000,
                'confirmButton' => true
            ];
        }

    } catch (mysqli_sql_exception $e) {
        $_SESSION['error'] = 'Gagal menambahkan barang: ' . $e->getMessage();
    }

    // Redirect ke halaman daftar setelah proses
    header("Location: ../daftar.php");  
    exit;
}