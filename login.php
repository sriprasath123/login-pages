<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous">
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap"
      rel="stylesheet">
  </head>
  <body>
  <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-12" style="margin-top: 5%;">
                <div class="background">
                    <div class="shape"></div>
                    <div class="shape"></div>
                </div>
                <form action="" method="post">
                    <h3>Login</h3>
                    <label for="username"></label>
                    <input type="text" name="username" placeholder="Username" id="username" required>
                    <label for="password"></label>
                    <input type="password" name="password" placeholder="Password" id="password" required><br><br>
                    <span id="pass"><?php if(isset($_POST['submit'])) { echo "Incorrect password"; } ?></span>
                    <button type="submit" class="Btn" name="submit">Login</button><br>
                    <p>Don't have an account? <a href="index.php">Register</a></p>
                    <div class="social">
                        <div class="go"><i class="fab fa-google"></i> Google</div>
                        <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
                    </div>
                </form>
                <img class="ludoimg" src="./assets/img/sr3-removebg-preview.png" alt="">

            </div>
           
        </div>
    </div>

  </body>
</html>


<?php
include "db_conn.php";

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM register WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            echo "<script>
                    alert('Login successful!  click on the ok button ');
                    window.location.href = 'assets/dashboard.php';
                 </script>";
            exit;
        }
    }

    $stmt->close();
}

$conn->close();
?>