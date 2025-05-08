
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="/assets/modules/summernote/summernote-bs4.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">

</head>

<body>
  <div id="app">
    
  <!-- Navbar Custom Style -->
  <?= $this->include('layout/nav') ?>

      <!-- Main Content -->
      <div class="main-content">
        
        <?= $this->renderSection('content') ?>
        

      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Nauval Azhar</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts (via CDN) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="/assets/js/stisla.js"></script> <!-- Tidak tersedia di CDN publik, tetap pakai lokal -->

<!-- JS Libraries (via CDN jika tersedia) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.1.0/jquery.simpleWeather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.world.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chocolat/0.4.21/js/jquery.chocolat.min.js"></script>

<!-- Page Specific JS File -->
<script src="/assets/js/page/index-0.js"></script> <!-- tidak umum, tetap lokal -->

<!-- Template JS File -->
<script src="/assets/js/scripts.js"></script> <!-- tidak umum, tetap lokal -->
<script src="/assets/js/custom.js"></script> <!-- tidak umum, tetap lokal -->

</body>
</html>
