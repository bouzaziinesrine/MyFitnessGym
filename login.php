<?php

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) )
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
                    // Authentication successful, set session and redirect based on role
                    $_SESSION['user_id'] = $user_data['user_id'];
                    if ($user_data['role'] === 'admin') {
                        header("Location: admin.php");
                    } elseif ($user_data['role'] === 'user') {
                        header("Location: home.php");
                    }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Login</title>
    <style>
    .btn{
    height: 35px;
    background: rgb(235,119,6);
    border: 0;
    border-radius: 5px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 10px;
    padding: 0px 10px;
}
.btn:hover{
    opacity: 0.82;
}

</style>
</head>
<body>
    <a href="index.php">LogOut</a>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form method="post">
                <div class="field input">
					<label for="username">Username</label>
					<input type="text" name="user_name" placeholder="Username">
                    <!-- <input type="text" name="email" id="email" autocomplete="off" required> -->
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required placeholder="Password">
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>

                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>