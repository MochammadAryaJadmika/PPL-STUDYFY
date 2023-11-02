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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kode_kab = $_POST['kode_kab'];
    $kode_prov = $_POST['kode_prov'];
    $angkatan = $_POST['angkatan'];
    $jalur_masuk = $_POST['jalur_masuk'];
    $email = $_POST['email'];
    $handphone = $_POST['handphone'];
    $status = $_POST['status'];
    $username = $_POST['username']; // Retrieve the username

    // Simpan data ke database (misalnya dengan query UPDATE)
    $queryEdit = "UPDATE mahasiswa SET nama = '$nama', alamat = '$alamat', kode_kab = '$kode_kab', kode_prov = '$kode_prov', 
    jalur_masuk = '$jalur_masuk', email = '$email', handphone = '$handphone', status = '$status' WHERE nim = '$nim'";


    if ($db->query($queryEdit) === TRUE) {
        // Redirect kembali ke halaman ini setelah pembaruan berhasil
        header("Location: dashboardMHS.php");
    } else {
        echo "Error: " . $queryEdit . "<br>" . $db->error;
    }
}

// Ambil data buku yang akan diedit dari database
$queryData = "SELECT nim, nama, alamat, kode_kab, kode_prov, angkatan, jalur_masuk, email, handphone, status FROM mahasiswa WHERE username = '" . $username . "'";
$resultData = $db->query($queryData);
if (!$resultData) {
    die("Could not query the database: <br />" . $db->error);
} else {
    if ($resultData->num_rows > 0) {
        $row = $resultData->fetch_assoc();
    
        // Store NIM and Angkatan in variables
        $nim = $row['nim'];
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $kode_kab = $row['kode_kab'];
        $kode_prov = $row['kode_prov'];
        $angkatan = $row['angkatan'];
        $jalur_masuk = $row['jalur_masuk'];
        $email = $row['email'];
        $handphone = $row['handphone'];
        $status = $row['status'];

        // Mengambil data nama provinsi berdasarkan kode provinsi
        $queryProv = "SELECT nama_prov FROM prov WHERE kode_prov = '$kode_prov'";
        $resultProv = $db->query($queryProv);
        if ($resultProv && $resultProv->num_rows > 0) {
            $rowProv = $resultProv->fetch_assoc();
            $nama_prov = $rowProv['nama_prov'];
        } else {
            $nama_prov = "N/A";
        }

        // Mengambil data nama kabupaten berdasarkan kode kabupaten
        $queryKab = "SELECT nama_kab FROM kab WHERE kode_kab = '$kode_kab'";
        $resultKab = $db->query($queryKab);
        if ($resultKab && $resultKab->num_rows > 0) {
            $rowKab = $resultKab->fetch_assoc();
            $nama_kab = $rowKab['nama_kab'];
        } else {
            $nama_kab = "N/A";
        }

   } else {
       echo "No Data Found";
   }
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
    <link rel="stylesheet" type="text/css" href="../css/mhs/dashboardMHS.css">
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
</style>
<div class="flex">
    <!-- Navbar -->
    <div class="fixed top-0 left-0 right-0 flex bg-blue-900 p-5 text-white">
        <!-- Welcome Sentence (Moved to the right) -->
        <div class="text font-bold" style="margin-left: auto; margin-right: 45px; font-size: 18px;">Selamat Datang, Mahasiswa!</div>
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
                <p class="text-white text-center">Mahasiswa Informatika</p>
            </li>
            <br>
            <li class="mb-2">
                <a href="dashboardMHS.php" id="profil" class="text-white hover:bg-gray-600 px-4 py-2 block">Profil</a>
            </li>
            <li class="mb-2">
                <button class="collapsible text-white hover:bg-gray-600 px-3 py-2 block">Progress Akademik</button>
                <div class="submenu">
                    <a href="irs.php" id="irs" class="text-white hover:bg-gray-600 px-4 py-2 block">IRS</a>
                    <a href="khs.php" id="khs" class="text-white hover:bg-gray-600 px-4 py-2 block">KHS</a>
                    <a href="pkl.php" id="pkl" class="text-white hover:bg-gray-600 px-4 py-2 block">PKL</a>
                    <a href="skripsi.php" id="skripsi" class="text-white hover:bg-gray-600 px-4 py-2 block">Skripsi</a>
                </div>
            </li>
        </ul>
    </aside>


    <!-- Konten (belum) -->
    <main class="main-content flex-1 p-4">
            <div class="profilebox" id="profilebox">
                <h1 class="text-xl font-bold mb-4">Profil Mahasiswa</h1>
                <div>
                <div class="profile-box shadow">
                    <h1 class="text-dark text-center font-bold py-3">Mahasiswa Informatika UNDIP</h1>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="editForm">
                        <p class="content text-dark font-bold" style="font-size: 15px;">NIM</p>
                        <input type="text" name="nim" style="margin-left: 300px;" value="<?php echo $nim; ?>" disabled>
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-top: 15px;">Nama Lengkap</p>
                        <input type="text" name="nama" style="margin-left: 300px;" value="<?php echo $nama; ?>">
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-top: 15px;">Angkatan</p>
                        <input type="text" name="angkatan" style="margin-left: 300px;" value="<?php echo $angkatan; ?>" disabled>
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-top: 15px;">Jalur Masuk</p>
                        <input type="text" name="jalur_masuk" style="margin-left: 300px;" value="<?php echo $jalur_masuk; ?>">
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-top: 15px;">Alamat</p>
                        <input type="text" name="alamat" style="margin-left: 300px;" value="<?php echo $alamat; ?>">
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-left: 600px; margin-top: -291px;">Provinsi</p>
                        <input type="text" name="kode_prov" style="margin-left: 600px;" value="<?php echo $nama_prov; ?>">
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-left: 600px; margin-top: 13px;">Kabupaten/Kota</p>
                        <input type="text" name="kode_kab" style="margin-left: 600px;" value="<?php echo $nama_kab; ?>">
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-left: 600px; margin-top: 15px;">No.Telp</p>
                        <input type="text" name="handphone" style="margin-left: 600px;" value="<?php echo $handphone; ?>">
                        <p class="content text-dark font-bold" style="font-size: 15px; margin-left: 600px; margin-top: 16px;">Email</p>
                        <input type="text" name="email" style="margin-left: 600px;" value="<?php echo $email; ?>">
                        <input type="submit" value="Simpan" class="btn-db text-white hover:bg-gray-600 px-4 py-2 block"></input>
                    </form>
                    <div class="profil-box" style="display: flex">
                        <img src="../assets/images/user.png" class="profil-box px-10 py-2 d-block" style="margin-top: 50px;">
                        <img src="../assets/images/pencil.png" style="margin-left: 60px; margin-top: 150px; width: 15px; height: 15px;">
                        <a href="uploadfoto.php" style="margin-left: 10px; margin-top: 148px; font-size: 15px;">Upload Foto</a>
                    </div>
                    <p style="margin-left: 95px; margin-top: -125px; font-size: 15px;">Status Akademik</p>
                    <input class="status text-center py-1" type="text" name="status" style="background-color:springgreen; font-size: 15px;" value="<?php echo $status; ?>" disabled>
                    <div>   
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
    setActiveItem("profil");
</script>
</body>
</html>