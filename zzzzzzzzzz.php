<script>
    document.addEventListener('DOMContentLoaded', function() {
      const scanModal = new bootstrap.Modal('#scanModal');
      const cameraPermissionModal = new bootstrap.Modal('#cameraPermissionModal');
      let qrScanner = null;
      let isScanning = false;

      // Update tanggal
      function updateCurrentDate() {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = 
          new Date().toLocaleDateString('id-ID', options);
      }
      updateCurrentDate();

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
          if(navigator.permissions) {
            const status = await navigator.permissions.query({ name: 'camera' });
            return status.state;
          }
          return 'prompt';
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
            facingMode: "environment",
            showZoomSlider: true
          },
          false
        );

        qrScanner.render((decodedText) => {
          handleScanResult(decodedText);
        });
        
        isScanning = true;
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
          title: 'Akses Ditolak',
          html: 'Izin kamera diperlukan untuk memindai QR Code.<br>' +
            '<button class="btn btn-link mt-2" onclick="showHelpGuide()">' +
            '<i class="fas fa-question-circle"></i> Cara mengaktifkan' +
            '</button>'
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
    });
  </script>