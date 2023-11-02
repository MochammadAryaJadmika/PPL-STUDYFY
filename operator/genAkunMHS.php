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
// Pengambilan data jumlah operator
$queryOperator = "SELECT COUNT(*) AS total_operator FROM operator";
$resultOperator = $db->query($queryOperator);
if (!$resultOperator) {
    die("Could not query the database: <br />" . $db->error);
} else {
    $row = $resultOperator->fetch_assoc();
    $totalOperator = $row['total_operator'];
}

// Pengambilan data jumlah mahasiswa
$queryMahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM mahasiswa";
$resultMahasiswa = $db->query($queryMahasiswa);
if (!$resultMahasiswa) {
    die("Could not query the database: <br />" . $db->error);
} else {
    $row = $resultMahasiswa->fetch_assoc();
    $totalMahasiswa = $row['total_mahasiswa'];
}

// Pengambilan data jumlah dosen wali
$queryDoswal = "SELECT COUNT(*) AS total_doswal FROM dosen";
$resultDoswal = $db->query($queryDoswal);
if (!$resultDoswal) {
    die("Could not query the database: <br />" . $db->error);
} else {
    $row = $resultDoswal->fetch_assoc();
    $totalDoswal = $row['total_doswal'];
}

$db->close();
?>

<style>
    .button-container {
    display: flex;
}

.button-container a {
    margin-right: 10px; /* Atur jarak antara tombol */
}

</style>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../assets/img/logo2.png" />
    <!-- <link rel="shortcut icon" href="https://kulon2.undip.ac.id/pluginfile.php/1/theme_moove/favicon/1660361299/undip.ico" /> -->
    <link rel="stylesheet" type="text/css" href="../css/opt/dashboardOPT.css"> 
    <!-- <script src="../js/scripts.js"></script> -->
</head>
<body>
<style>
    .profile-box {
        background-color: lightskyblue;
        width: 980px;
        height: 465px;
        box-sizing: border-box;
        border-radius: 10px;
        margin-top: 10px;
        margin-right: auto;
    }
    .sharpened-shadow {
    box-shadow: 0 0 10px 3px rgba(0, 0, 0, 0.3);
    }
    .custom{
        border-radius: 10px;
    }

</style>

<div class="flex">
    <!-- Navbar -->
    <div class="fixed top-0 left-0 right-0 flex bg-blue-900 p-5 text-white">
        <!-- Welcome Sentence (Moved to the right) -->
        <div class="text font-bold" style="margin-left: auto; margin-right: 45px; font-size: 18px;">Selamat Datang, Operator!</div>
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
                <p class="text-white text-center">Admin Informatika</p>
            </li>
            <br>
            <li class="mb-2">
                <a href="dashboardOPT.php" id="dashboard" class="text-white hover:bg-gray-600 px-4 py-2 block">Dashboard</a>
            </li>

            <li class="mb-2">
                <button class="collapsible text-white hover:bg-gray-600 px-3 py-2 block">Generate Akun</button>
                <div class="submenu">
                    <a href="genAkunMhs.php" id="gen_mhs" class="text-white hover:bg-gray-600 px-4 py-2 block">Mahasiswa</a>
                    <a href="genAkunDsn.php" id="gen_dsn" class="text-white hover:bg-gray-600 px-4 py-2 block">Dosen</a>
                </div>
            </li>
            <li class="mb-2">
                <button class="collapsible text-white hover:bg-gray-600 px-3 py-2 block">Manajemen Akun</button>
                <div class="submenu">
                    <a href="manAkunMhs.php" id="man_mhs" class="text-white hover:bg-gray-600 px-4 py-2 block">Mahasiswa</a>
                    <a href="manAkunDsn.php" id="man_dsn" class="text-white hover:bg-gray-600 px-4 py-2 block">Dosen</a>
                </div>
            </li>
            <!-- <li class="mb-2">
                <a href="../logout.php" id="logout" class="text-white hover:bg-gray-600 px-4 py-2 block">Logout</a>
            </li> -->
        </ul>
    </aside>


    <!-- Konten (belum) -->
        <main class="main-content p-4">
            <div class="p-10 bg-lightgrey rounded shadow-lg sharpened-shadow"  style="background-color: #F0F0F0;width:1000px">
                <h1 class="text-xl font-bold mb-4">Generate Akun Mahasiswa</h1>

                <!--Tab Dosen-->
                    <div class="mb-4 form-group">
                        <h2 class="font-bold">NIM</h2>
                        <input type=text placeholder="Masukkan NIM" class="w-full border rounded p-2 form-control custom">
                    </div>

                    <div class="mb-4 form-group">
                        <h2 class="font-bold">Nama Mahasiswa</h2>
                        <input type=text placeholder="Masukkan Nama" class="w-full border rounded p-2 form-control custom">
                    </div>

                    <div class="mb-4 form-group">
                        <h2 class="font-bold">Status</h2>
                        <select id="status" name="status" class="w-full py-2 border rounded form-control custom">
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Mangkir">Mangkir</option>
                            <option value="DO">DO</option>
                            <option value="Undur Diri">Undur Diri</option>
                            <option value="Meninggal Dunia">Meninggal Dunia</option>
                            <option value="Lulus">Lulus</option>
                        </select>
                    </div>
            </div>
        </main> 
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

    // Set item aktif pada "dashboard" saat halaman di load pertama kali
    setActiveItem("gen_dsn");
</script>
</body>
</html>