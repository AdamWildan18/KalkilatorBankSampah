<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kalkulator Bank Sampah</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <nav class="sidebar bg-dark">
        <ul id="sidebar_menu">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/kelola-sampah">Pengelolaan Data</a></li>
            <li><a href="/">Home</a></li>
        </ul>
    </nav>
    <section class="main_content dashboard_part large_header_bg mt-4">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-10">
                    <div class="content">
                        <input type="checkbox" id="sidebarToggle" class="d-none d-lg-block">
                        <label class="form-label switch_toggle d-none d-lg-block" for="sidebarToggle"></label>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        $(document).ready(function () {
    // Tangkap elemen checkbox
    const sidebarToggle = document.getElementById('sidebarToggle');

    // Tambahkan event listener saat checkbox berubah
    sidebarToggle.addEventListener('change', function () {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main_content');

        if (this.checked) {
            // Tampilkan sidebar
            sidebar.style.display = 'block';
            // Geser konten ke kanan
            mainContent.style.marginLeft = '250px';
        } else {
            // Sembunyikan sidebar
            sidebar.style.display = 'none';
            // Kembalikan konten ke posisi awal
            mainContent.style.marginLeft = '0';
        }
    });
});

    </script>
</body>
</html>