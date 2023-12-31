<?php
session_start();
require_once('../lib/db_login.php');
// include("../template/headermahasiswa.php");

// Pengambilan data username
$username = $_SESSION['username'];
$queryUsername = "SELECT * FROM users WHERE username = '" . $username . "'";
$resultUsername = $db->query($queryUsername);
if (!$resultUsername) {
    die("Could not query the database: <br />" . $db->error);
} else {
    if ($resultUsername->num_rows > 0) {
        $_SESSION['username'] = $username;
    }else {
        // Jika username dari user tidak ditemukan
        $username = "Guest";
    }
}

// Pengambilan data NIP
$queryNIP = "SELECT nip FROM dosen WHERE username = '" . $username . "'";
$resultNIP = $db->query($queryNIP);
if (!$resultNIP) {
    die("Could not query the database: <br />" . $db->error);
} else {
    if ($resultNIP->num_rows > 0) {
        $row = $resultNIP->fetch_assoc();
        $nip = $row["nip"];
    }

}

// Pengambilan data jumlah mahasiswa aktif
$queryMahasiswaAktif = "SELECT COUNT(*) AS total_mahasiswa_aktif FROM mahasiswa WHERE status = 'Aktif 2023'";
$resultMahasiswaAktif = $db->query($queryMahasiswaAktif);
if (!$resultMahasiswaAktif) {
    die("Could not query the database: <br />" . $db->error);
} else {
    $row = $resultMahasiswaAktif->fetch_assoc();
    $totalMahasiswaAktif = $row['total_mahasiswa_aktif'];
}

// Pengambilan data jumlah mahasiswa cuti
$queryMahasiswaCuti = "SELECT COUNT(*) AS total_mahasiswa_cuti FROM mahasiswa WHERE status = 'Cuti'";
$resultMahasiswaCuti = $db->query($queryMahasiswaCuti);
if (!$resultMahasiswaCuti) {
    die("Could not query the database: <br />" . $db->error);
} else {
    $row = $resultMahasiswaCuti->fetch_assoc();
    $totalMahasiswaCuti = $row['total_mahasiswa_cuti'];
}

$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../assets/img/logo2.png" />
    <!-- <link rel="shortcut icon" href="https://kulon2.undip.ac.id/pluginfile.php/1/theme_moove/favicon/1660361299/undip.ico" /> -->
    <link rel="stylesheet" type="text/css" href="../css/dsn/dashboardDSN.css">
    <!-- <script src="../js/scripts.js"></script> -->
</head>
<body>

<div class="flex">
    <!-- Navbar -->
    <div class="fixed top-0 left-0 right-0 flex bg-blue-900 p-5 text-white">
        <!-- Welcome Sentence (Moved to the right) -->
        <div class="text font-bold" style="margin-left: auto; margin-right: 45px; font-size: 18px;">Selamat Datang, Dosen!</div>
        <!-- User Picture -->
        <div class="profiltop">
            <img src="../assets/images/user.png" class="profile w-9 h-9 rounded-full cursor-pointer" id="user-menu-toggle" style="margin-left: 10px; margin-right: 5px; margin-top: 5px;">
            <!-- User Menu (submenu) -->
            <div class="absolute right-0 mt-2 bg-gray-900 text-white p-2 w-32 rounded-lg hidden" id="user-menu" style="margin-right: 5px;">
                <a href="../logout.php" class="block rounded py-2 hover:bg-gray-600 text-center">Logout</a>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <aside class="fixed-sidebar w-64 h-auto bg-gray-800 text-white p-4">
        <div style="display: flex; align-items: center;">
            <img src="../assets/img/logo2.png" style="margin-left: 5px; margin-bottom: 10px; width: 40px; height: 40px;">
            <h1 class="text-2xl font-bold mb-3 px-3">StudyfyIF</h1>
        </div>
        <ul>
            <li class="mb-2">
                <img src="../assets/images/user.png" class="profil-side px-6 py-2 mx-auto d-block">
            </li>
            <li>
                <p class="text-white text-center"><?php echo $username; ?></p>
                <p class="text-white text-center">NIP: <?php echo $nip; ?></p>
            </li>
            <br>
            <li class="mb-2">
                <a href="dashboardMHS.php" id="dashboard" class="text-white hover:bg-gray-600 px-4 py-2 block">Dashboard</a>
            </li>
            <li class="mb-2">
                <a href="dataMHS.php" id="datamhs" class="text-white hover:bg-gray-600 px-4 py-2 block">Data Mahasiswa Perwalian</a>
            </li>
            <li class="mb-2">
                <a href="dataMHS.php" id="datamhs" class="text-white hover:bg-gray-600 px-4 py-2 block">Progres Studi Mahasiswa</a>
            </li>
            <li class="mb-2">
                <button class="collapsible text-white hover:bg-gray-600 px-3 py-2 block">Data Mahasiswa</button>
                <div class="submenu">
                    <a href="pkl.php" id="pkl" class="text-white hover:bg-gray-600 px-4 py-2 block">PKL</a>
                    <a href="skripsi.php" id="skripsi" class="text-white hover:bg-gray-600 px-4 py-2 block">Skripsi</a>
                </div>
            </li>
        </ul>
    </aside>


    <!-- Konten (belum) -->
    <main class="main-content flex-1 p-4">
        <!-- CRUD -->
            <div class="profilebox" id="profilebox">
                <h1 class="text-xl font-bold mb-4">Dashboard</h1>
                <img class=grafik src="../assets/img/grafik.png">
                <div class="profile-box-12-container">
                <div class="profile-box-1 shadow">
                    <h1 class="text-dark text-8xl text-center font-bold py-5"><?php echo $totalMahasiswaAktif; ?></h1>
                    <p class="text-dark text-center">Total Mahasiswa Aktif</p>
                </div>
                <div class="profile-box-2 shadow px-10">
                    <h1 class="text-dark text-8xl text-center font-bold py-5"><?php echo $totalMahasiswaCuti; ?></h1>
                    <p class="text-dark text-center">Total Mahasiswa Cuti</p>
                </div>
                </div>
                </div>
            </div>
            <!-- End konten -->

<script>
    //JavaScript untuk menu collapse (progress akademik)
    const collapsibleButtons = document.querySelectorAll(".collapsible");

    // Add click event listeners to collapsible buttons
    collapsibleButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const submenu = button.nextElementSibling; // Use nextElementSibling
            if(submenu.style.display === "block" || submenu.style.display === "") {
                submenu.style.display = "none";
            }else{
                submenu.style.display = "block";
            }
        });
    });

    const userMenuToggle = document.getElementById('user-menu-toggle');
    const userMenu = document.getElementById('user-menu');

    userMenuToggle.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
    });

    // Fungsi untuk mengatur item aktif (menu dll)
    function setActiveItem(activeId) {
        const sidebarItems = document.querySelectorAll("aside a");
        sidebarItems.forEach((item) => {
            item.classList.remove("bg-green-600");
            item.classList.remove("text-gray-100");
        });

        const activeItem = document.getElementById(activeId);
        if (activeItem) {
            activeItem.classList.add("bg-blue-800");
            activeItem.classList.add("text-gray-100");
        }
    }

    // Set item aktif pada "profil" saat halaman di load pertama kali
    setActiveItem("dashboard");
</script>
</body>
</html>