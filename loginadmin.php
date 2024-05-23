<?php
session_start();

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password) )
		{

			//read from database
			$query = "select * from admin_users where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['password'] === $password)
					{
						$_SESSION['admin_id'] = $user_data['admin_id'];
						header("Location: admin.php");
						exit;
					}
				}
			}
			echo "wrong username or password!";
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Admin Login</title>
    
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Admin Login</header>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo "<div class='error-message'>Incorrect username or password!</div>";
            }
            ?>
            <form method="post" action="loginadmin.php">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="field input">
                    <input type="submit" class="btn" value="Login">
                </div>
                <div class="links">
                    No? <a href="login.php">Go Back</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
