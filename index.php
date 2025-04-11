<?php 
session_start();

include("database.php");?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
	<link rel="icon" type="image/png" href="image/logo.jpg">
	<title>BMOC</title>
   
</head>
	<body>
		<section>
				<div class="imgBx">
					<img src="image/logo.jpg" alt="Login background image">
				</div>
				<div class="contentBx">
					<div class="formBx">
						<h2>Welcome back!</h2>
						<?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
					$_SESSION['username'] = $row['username'];
                    header("Location: patient.php");
                    die();
                }else{
                   
                }
            }else{
               
            }
        }
        ?>
						<form action="index.php" method="POST">
							<!-- Username input -->
							<div class="inputBx">
								<span>Email</span>
								<input type="email" name="email">
							</div>
							<!-- Password input -->
							<div class="inputBx">
								<span>Password</span>
								<input type="password" name="password">
							</div>
							<!-- Remember Me input -->
							<div class="remember">
								<label><input type="checkbox">Remember me</label>
							</div>
							<!-- Submit button -->
							<div class="inputBx">
								<input type="submit" value="Login" name="login">
							</div>
						
						</form>
							<!-- Option to sign up -->
							<div class="inputBx">
								<p>Don't have an account yet? <a href="registration/register.php">Sign Up</a></p>
							</div>
					</div>
				</div>
		</section>
	</body>
</html>
