<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
// buat yang diinput user
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

   
    if ($password != $confirm) {
        echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
    } else {
// masukkan data ke database
        mysqli_query(
            $conn,
            "INSERT INTO user(username, password) 
        VALUES('$username', '$password')"
        );

        echo "<script>
        alert('Register berhasil!');
        window.location='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: Poppins;
            background: linear-gradient(to right, #ffe4ec, #fff0f5);
        }

        .logo {
            width: 200px;
            margin-bottom: 20px;
        }

        .box {
            width: 350px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            text-align: center;

            box-shadow: 0 0 15px pink;
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 10px;
            border-radius: 15px;
            border: 1px solid pink;
        }

        button {
            background: pink;
            border: none;
            padding: 12px 25px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: hotpink;
            color: white;
        }
    </style>
</head>

<body>

    <div class="box">
        
        <img src="images/logo.jpeg" class="logo">

        <h2><i class="bi bi-heart-fill"></i> Register GLOWGUIDE</h2>

        <form method="POST">

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="password" name="confirm" placeholder="Konfirmasi Password" required>

            <button type="submit" name="register">
                Register
            </button>

        </form>

    </div>

</body>

</html>