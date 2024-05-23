<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
    <style>
        .btn {
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
        .btn:hover {
            opacity: 0.82;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        margin: 20px auto;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
            <?php
            session_start();
            include("connection.php");

            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                $id = $_SESSION['user_id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$id'");

                // Check if the user exists
                if ($query && mysqli_num_rows($query) > 0) {
                    $result = mysqli_fetch_assoc($query);
                    $user_name = $result['user_name'];
                    $res_Age = $result['age'];
                    $profile_image = $result['fileToUpload'];
                    echo "<a href='logout.php'><button class='btn'>Log Out</button></a>";
                } else {
                    echo "User not found.";
                }
            } else {
                // If user is not logged in, redirect to login page
                header("Location: login.php");
                exit();
            }
            ?>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <?php if (!empty($profile_image)): ?>
                        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image" class="profile-img">
                    <?php endif; ?>
                    <p>Hello <b><?php echo htmlspecialchars($user_name ?? ''); ?></b>, Welcome</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>And you are <b><?php echo htmlspecialchars($res_Age ?? ''); ?> years old</b>.</p> 
                </div>
            </div>
        </div>
    </main>
    
<h1>Gym Planning</h1>
<table>
    <tr>
        <th>Day</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Activity</th>
        <th>Trainer</th>
        <th>Location</th>
        <th>Capacity</th>
    </tr>
    <tr>
        <td>Monday</td>
        <td>09:00 AM</td>
        <td>10:00 AM</td>
        <td>Cardio</td>
        <td>John Doe</td>
        <td>Main Hall</td>
        <td>20</td>
    </tr>
    <tr>
        <td>Tuesday</td>
        <td>10:00 AM</td>
        <td>11:00 AM</td>
        <td>Yoga</td>
        <td>Jane Smith</td>
        <td>Yoga Studio</td>
        <td>15</td>
    </tr>
    <tr>
        <td>Wednesday</td>
        <td>06:00 PM</td>
        <td>07:00 PM</td>
        <td>Weight Training</td>
        <td>Michael Johnson</td>
        <td>Main Gym Floor</td>
        <td>25</td>
    </tr>
    <!-- Add more rows as needed -->
</table> 
</body>
</html>
