<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: dashboard.php");
    exit();
}

include 'koneksi.php';

if (isset($_POST['login'])) {
// buat yang diinput user
    $username = $_POST['username']; 
    $password = $_POST['password'];
// cocokin dengan yang ada di database
    $query = mysqli_query(
        $conn,
        "SELECT * FROM user
    WHERE username='$username'
    AND password='$password'"
    );
// cek apakah ada yang cocok
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {

        $_SESSION['login'] = true;

        header("Location: dashboard.php");
        exit();

    } else {

        echo "<script>
        alert('Username atau Password salah!');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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

        a {
            text-decoration: none;
            color: hotpink;
        }
    </style>
</head>

<body>

    <div class="box">
         
     <img src="images/logo.jpeg" class="logo">

        <h2><i class="bi bi-heart-fill"></i> Login GLOWGUIDE</h2>

        <form method="POST">

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">
                Login
            </button>

        </form>

        <p>
            Belum punya akun?
            <a href="register.php">Register</a>
        </p>

    </div>

</body>

</html>