<?php
session_start();
require_once('./lib/db_login.php');

$error_message = '';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Memeriksa apakah user sudah mengklik tombol login
if (isset($_POST['login'])) {
    $valid = TRUE;

    // Memeriksa validasi username
    $username = test_input($_POST['username']);
    if ($username == '') {
        $error_username = 'Username harus diisi';
        $valid = FALSE;
    }

    // Memeriksa validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = 'Password harus diisi';
        $valid = FALSE;
    }

    // Memeriksa validasi
    if ($valid) {
        // Assign query
        $query = "SELECT * FROM users WHERE username='" . $username . "' AND Password='" . md5($password) . "' ";
        $result = $db->query($query);
        if (!$result) {
            die("Couldn't query the database: <br/>" . $db->error);
        } else {
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $_SESSION['status'] = "login";
                $_SESSION['username'] = $username;
                if ($row->role == "mahasiswa") {
                    header('Location:./mahasiswa/dashboardMHS.php');
                } else if ($row->role == "operator") {
                    header('Location: ./operator/dashboardOPT.php');
                } else if ($row->role == "departemen") {
                    header('Location:./departemen/dashboardDPT.php');
                } else {
                    header('Location:./dosen/dashboardDSN.php');
                }
                exit;
            } else {
                $error_message = "Username atau password salah. Silahkan coba lagi.";
            }
        }
        $db->close();
    }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <script src="https://kit.fontawesome.com/b6d15a1885.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
    <link rel="shortcut icon" href="https://kulon2.undip.ac.id/pluginfile.php/1/theme_moove/favicon/1660361299/undip.ico" />
</head>
<style>
    .center-content {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
</style>
<body>

<main>
    <div class="container-login">
        <div class="row justify-content-center align-item-center">
            <div class="col-lg-10 col-md-10 col-sm-12 py-md-5">
                <div class="row shadow">
                    <div class="col-lg-6 col-md-6 col-sm-12 p-0 p-md-0 order-1 order-md-0">
                        <img src="./assets/img/logo1.jpg" alt="..." style="width:675px; height:545px;">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 p-4 p-md-5 order-1 order-md-0">
                        <div class="center-content">
                            <img src="./assets/img/logo_undip.png" class="img-fluid mb-3 ml-md-4 ml-sm-5" width="120px" alt="Logo">
                            <h4 style="font-weight: bolder;">StudyfyIF</h4>
                            <p class="mb-3">Universitas Diponegoro</p>
                        </div>
<!--<body class="" style="background-image: url(./assets/img/logo1.jpg);background-repeat: no-repeat; background-size: 880px 740px;">
<div class="main d-flex flex-column justify-content-center">
<div class="login-box shadow" style="background-color:white;">
<div class=" thumbnail p-4" ><img class="rounded mx-auto d-block" style="width: 4cm; height: 4cm;"src="./assets/img/logo_undip.png"/></div>
<div class="error"><?php if(isset($error_login)) echo $error_login;?></div>-->
                        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
                        <div class="error-message text-center"><?php echo $error_message; ?></div>
                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label" style="font-size: small"> Username <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" placeholder="Masukkan username" id="users" name="username" maxlength="50"  value="<?php if(isset($username)) echo $username;?>">
                                <div class="error"><?php if(isset($error_username)) echo $error_username;?></div>
                            </div>
                            <!-- Password -->
                            <div class="mb-3 position-relative">
                                <label class="form-label" style="font-size: small"> Password <span style="color: red;">*</span></label>
                                <div class="input-group">
                                <input type="password" class="form-control fakepassword" id="password" name="password" placeholder="Masukkan Password" required>
                                    <div class="error"><?php if(isset($error_password)) echo $error_password;?></div>
                                        <span class="input-group-text p-0">
                                            <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                            </div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark" name="login" value="login">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>