<?php 
use Bpjs\Framework\Helpers\Bpjs;
use Bpjs\Framework\Helpers\Session;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta name="csrf-token" content="<?= csrfHeader() ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>SPK MDF</title>

    <!-- CSS files -->
    <link href="<?= asset('tabler/dist/css/tabler.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/tabler-flags.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/tabler-payments.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/tabler-vendors.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/demo.min.css?1692870487')?>" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?=  asset('logo/iconkoperasi.png') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?=  asset('logo/iconkoperasi.png') ?>" type="image/png">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- OTHERS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    

    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      .select2-container {
          z-index: 999999 !important;
      }
      /* Supaya Select2 mirip form-control Bootstrap/Tabler */
      .select2-container--default .select2-selection--single {
          height: calc(1.5em + .75rem + 2px); /* Tinggi standar Bootstrap */
          padding: .375rem .75rem;
          font-size: 1rem;
          line-height: 1.5;
          color: #495057;
          background-color: #fff;
          border: 1px solid #ced4da;
          border-radius: .375rem;
      }

      .select2-container--default .select2-selection--single .select2-selection__rendered {
          line-height: 1.5;
          color: #495057;
          padding-left: 0;
      }

      .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 100%;
          right: 10px;
      }
    </style>
  </head>
  <body>
    <script src="<?= asset('tabler/dist/js/demo-theme.min.js?1692870487')?>"></script>
    <div class="page">
      <!-- Sidebar -->
      <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark">
            <a href="#">
              SPK MOLD
            </a>
          </h1>
          <div class="navbar-nav flex-row d-lg-none">
            <div class="d-lg-none mt-1 d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Enable dark mode" data-bs-original-title="Enable dark mode">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Enable light mode" data-bs-original-title="Enable light mode">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path></svg>
              </a>
              <div class="nav-item dropdown d-none d-md-flex me-4">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" id="">
                  <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                  <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Last updates</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
                      <div class="list">
                        <div class="row align-items-center">
                          <div class="col text-truncate mb-2">
                            <a href="" class="text-body text-center mt-2 d-block">View More</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(<?= asset('default_profil.webp')?>)"></span>
                  <div class="d-none d-xl-block ps-2">
                    <div><?= Session::user()->name?></div>
                    <div class="mt-1 small text-secondary">
                      <?= Session::user()->role?>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <a href="" class="dropdown-item">Profile</a>
                  <form action="" method="post">
                    <?= csrf()?>
                    <button class="dropdown-item">Logout</button>
                  </form>
                </div>
              </div>
          </div>
          <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
              <li class="nav-item">
                <a class="nav-link" href="<?= route('home')?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Home
                  </span>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= $title == 'Management User' || $title == 'Management Material' ? 'show' : '' ?>" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="true" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-database-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" /><path d="M4 6v6c0 1.657 3.582 3 8 3c.21 0 .42 -.003 .626 -.01" /><path d="M20 11.5v-5.5" /><path d="M4 12v6c0 1.657 3.582 3 8 3" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Master Data
                  </span>
                </a>
                <div class="dropdown-menu <?= $title == 'Management User' || $title == 'Management Material' ? 'show' : '' ?>">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="<?= route('users')?>">
                        Users
                      </a>
                      <a class="dropdown-item" href="<?= route('materials')?>">
                        Materials
                      </a>
                    </div>
                  </div>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= route('tickets')?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M13.199 14.399a2 2 0 1 0 -1.199 3.601" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v2.5" /><path d="M17.001 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
                  </span>
                  <span class="nav-link-title">
                    SPK
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-guide"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M7 19h3a2 2 0 0 0 2 -2v-8a2 2 0 0 1 2 -2h7" /><path d="M18 4l3 3l-3 3" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Flow Process
                  </span>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle show" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-progress-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" /><path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" /><path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" /><path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" /><path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" /><path d="M9 12l2 2l4 -4" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Approval
                  </span>
                </a>
                <div class="dropdown-menu show">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="">
                        SPK
                      </a>
                    </div>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-doc"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /><path d="M20 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" /><path d="M12.5 15a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1 -3 0v-3a1.5 1.5 0 0 1 1.5 -1.5z" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Report
                  </span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="#">
                        Report SPK
                      </a>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </aside>
      <div class="page-wrapper">
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <div class="page-pretitle">
                  Dashbord
                </div>
                <h2 class="page-title">
                  Sistem Perintah Kerja
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none d-none d-lg-flex">
                <div class="d-none d-md-flex">
                  <a href="?theme=dark" class="nav-link px-0 hide-theme-dark me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Enable dark mode" data-bs-original-title="Enable dark mode">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path></svg>
                  </a>
                  <a href="?theme=light" class="nav-link px-0 hide-theme-light me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Enable light mode" data-bs-original-title="Enable light mode">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path></svg>
                  </a>
                  <div class="nav-item dropdown d-none d-md-flex me-4">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" id="showNotif">
                      <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                      <span class="badge bg-red" style="display:none" id="alertnotif"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Last updates</h3>
                        </div>
                        <div class="list-group list-group-flush list-group-hoverable">
                          <div id="notif"></div>
                          <div class="list">
                            <div class="row align-items-center">
                              <div class="col text-truncate mb-2">
                                <a href="" class="text-body text-center mt-2 d-block">View More Approval</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="navbar-nav ms-auto"> 
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url(<?= asset('default_profil.webp')?>)"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div><?= Session::user()->name?></div>
                                <div class="mt-1 small text-secondary">
                                  <?= Session::user()->role?>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">Profile</a>
                            <form action="<?= route('auth.logout')?>" method="post">
                              <?= csrf()?>
                              <button class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <?= $content?>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="https://crashmyname.github.io" target="_blank" class="link-secondary" rel="noopener">Develop By Fadli</a></li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2023
                    <a href="https://tabler.io/admin-template" class="link-secondary">Tabler</a>.
                    All rights reserved.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <link rel="stylesheet" href="<?= asset_v('css/table-plus.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- OTHERS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Libs JS -->
    <script src="<?= asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/jsvectormap/dist/maps/world.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/fslightbox/index.js?1692870487')?>" defer></script>
    <!-- Tabler Core -->
    <script src="<?= asset('tabler/dist/js/tabler.min.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/js/demo.min.js?1692870487')?>" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $(document).ajaxError(function(event, xhr) {
          if (xhr.status === 401) {
              window.location.href = '<?= url('/login')?>';
          }
      });
    </script>
  </body>
</html>