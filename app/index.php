<?php 
session_start();
$user=$_SESSION['user'];
if (!isset($user)){
    ?>
    <script>
        document.location.href='../index.php';
    </script>
    <?php
} else {    
    include "boot.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-REHJTs1UaY++2oN5gD1+yOr+zQhNmVC3zx6bKS/LeF7CYzsJKAf+qjgpALkjcPf5" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-puwjSOWHzrJDBZqTsF/ObPW8Wv0OPoOrn+tF0ECKvV+Onq+56zz+dRLZC9RBfDgj" crossorigin="anonymous">
    <style>
        /* General Styling */
        body {
            background-image: url('https://images.pexels.com/photos/457881/pexels-photo-457881.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(to right, #2C96EA, #42A6E3); /* Warna biru langit dengan gradien */
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            font-weight: bold;
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(to bottom, #2C96EA, #42A6E3); /* Warna biru langit dengan gradien */
            color: #fff;
            padding: 20px;
            border-right: 1px solid #dee2e6;
            height: 100vh;
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            overflow-x: hidden;
            z-index: 900;
            transition: all 0.3s ease;
        }

        .sidebar-menu-link:hover {
            color: #28a745; /* Warna hijau */
        }  

        .sidebar.active {
            left: 0;
        }

        .sidebar-title {
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
        }

        .sidebar-menu-item {
            margin-bottom: 10px;
            opacity: 0;
            transform: translateX(-20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .sidebar-menu-item.active {
            opacity: 1;
            transform: translateX(0);
        }

        .sidebar-menu-link {
            color: #fff;
            text-decoration: none;
        }

        .sidebar-menu-link:hover {
            color: #28a745;
        }

        .content {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-dark">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">
  <img src="https://png.pngtree.com/png-clipart/20201127/ourmid/pngtree-small-fresh-notes-graduation-book-guestbook-text-box-png-image_2444840.jpg" alt="Buku Tamu Logo" style="width: 30px; height: 30px;">
  BUKU TAMU
</a>

            <form class="d-flex ms-auto" role="search" action="search.php" target="konten" method="post" onsubmit="return validateSearchForm()">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari" id="searchInput">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Akun
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><?=$user ?></a></li>
                    <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-title">Menu</div>
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item"><a href="dashboard.php" target="konten" class="sidebar-menu-link"><i class="fas fa-tachometer-alt"></i> Home</a></li>

            <li class="sidebar-menu-item"><a href="input.php" target="konten" class="sidebar-menu-link"><i class="fas fa-user-plus"></i> Input Data Tamu</a></li>

            <li class="sidebar-menu-item"><a href="datatamu.php" target="konten" class="sidebar-menu-link"><i class="fas fa-address-book"></i> Data Tamu</a></li>

            <li class="sidebar-menu-item"><a href="rekap.php" target="konten" class="sidebar-menu-link"><i class="fas fa-chart-bar"></i> Rekap</a></li>

            <li class="sidebar-menu-item"><a href="rekapdatatamu.php" target="konten" class="sidebar-menu-link"><i class="fas fa-chart-bar"></i> Rekap data tamu Perbulan</a></li>
            
            <li class="sidebar-menu-item"><a href="logout.php" class="sidebar-menu-link" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
        </ul>
    </div>
    <!-- End Sidebar -->

    <!-- Main Content -->
    <div class="content" id="content">
        <iframe src="" name="konten" frameborder="50" width="500%" height="800"></iframe> 
    </div> 
    <!-- End Main Content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha384-Bf4b2pDGqvUhGwA3EOMfSGD0cWqbLeBBzVQOKKwvGlpp8xr9agt56HHW2mIv4+cA" crossorigin="anonymous"></script>
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
            var menuItems = document.querySelectorAll('.sidebar-menu-item');
            menuItems.forEach(function(item, index) {
                if (item.classList.contains('active')) {
                    item.classList.remove('active');
                } else {
                    setTimeout(function() {
                        item.classList.add('active');
                    }, index * 100);
                }
            });
        });

        function validateSearchForm() {
            var searchInput = document.getElementById('searchInput').value.trim();
            if (searchInput === '') {
                alert('Please enter a search keyword.');
                return false; // prevent form submission
            }
            // Allow form submission if input is not empty
            return true;
        }
    </script>
</body>
</html>



<?php
}
?>