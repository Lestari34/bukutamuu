!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            padding-top: 50px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .display-4 {
            color: #343a40;
            animation: bounceInDown 1s ease;
        }

        .lead {
            color: #6c757d;
        }

        .bi {
            vertical-align: middle;
        }

        .sidebar-menu-item {
            margin-bottom: 10px;
        }

        .sidebar-menu-link {
            display: block;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar-menu-link:hover {
            background-color: #0056b3;
        }

        .sidebar-menu-link.logout {
            background-color: #dc3545 !important;
        }

        .sidebar-menu-link.logout:hover {
            background-color: #c82333 !important;
        }

        /* Animasi loading */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-text {
            font-size: 24px;
            color: #343a40;
        }
    </style>
</head>

<body>
    <div class="loading" id="loading">
        <p class="loading-text">Mohon tunggu sebentar...</p>
    </div>

    <div class="container" id="content" style="display: none;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <hr>
                <h1 class="display-4 text-center mb-5 animate_animated animate_bounceInDown">
                    <i class="bi bi-book-half"></i> Selamat Datang di Buku Tamu
                </h1>
                <hr>
                <ul class="list-unstyled">
                    <li class="sidebar-menu-item">
                        <a href="input.php" target="konten" class="sidebar-menu-link" style="background-color: #17a2b8;">
                            <i class="bi bi-person-plus"></i> Input Data Tamu
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="datatamu.php" target="konten" class="sidebar-menu-link" style="background-color: #28a745;">
                            <i class="bi bi-journal-bookmark"></i> Data Tamu
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="rekap.php" target="konten" class="sidebar-menu-link" style="background-color: #ffc107;">
                            <i class="bi bi-bar-chart"></i> Rekap
                        </a>
                    </li>
                   
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link logout" onclick="logout()" style="background-color: #dc3545;">
                            <i class="bi bi-box-arrow-right"></i> Log Out
                        </a>
                    </li>
                </ul>
                <div class="card bg-light border-0">
                    <div class="card-body text-center">
                        <p class="lead" style="color: #6c757d;">
                            Selamat datang,! Di sini, Anda dapat melakukan
                            berbagai hal terkait buku tamu.
                        </p>
                        <p class="lead" style="color: #6c757d;">
                            Silakan gunakan navigasi di sebelah kiri untuk berpindah antar menu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan konten setelah loading
        window.addEventListener('load', function () {
            var loading = document.getElementById('loading');
            var content = document.getElementById('content');

            // Menyembunyikan loading dan menampilkan konten setelah 1 detik
            setTimeout(function () {
                loading.style.display = 'none';
                content.style.display = 'block';
            }, 1000);
        });

        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                window.location.href = "logout.php";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybB5IXNxFwWQfE7u8Lj+XJHAxKlXiG/8rsrtpb6PEdzD828Ii"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-Zhu7JqqK5hxc/pLT8hEz1j7Xqc7kL+Ht4XQ7z3py+IBC5W0E9QG/W1zrTs8kUQ4"
        crossorigin="anonymous"></script>
</body>

</html>