<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .reset-password-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        .reset-password-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .reset-password-container label {
            display: block;
            text-align: left;
            font-size: 14px;
            color: #333;
            margin-top: 10px;
        }
        .reset-password-container input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .reset-password-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .reset-password-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    require("database.php");

    if (isset($_GET['email']) && isset($_GET['token'])) {
        date_default_timezone_set('Asia/Pokhara');
        $date = date("Y-m-d");
        
        $query = "SELECT * FROM `register_user` WHERE `email` = ? AND `token` = ? AND `t_expire` = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sss", $_GET['email'], $_GET['token'], $date);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows === 1) { // If the token is valid
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                    $update_query = "UPDATE `register_user` SET `password` = ?, `token` = NULL, `t_expire` = NULL WHERE `email` = ?";
                    $update_stmt = $con->prepare($update_query);
                    $update_stmt->bind_param("ss", $hashed_password, $_GET['email']);

                    if ($update_stmt->execute()) {
                        echo "<script>alert('Password reset successful!'); window.location.href='index.php';</script>";
                    } else {
                        echo "<script>alert('Failed to update password. Please try again later.');</script>";
                    }
                } else {
                    echo "<script>alert('Passwords do not match. Please try again.');</script>";
                }
            }
    ?>

            <div class="reset-password-container">
                <h2>Reset Password</h2>
                <form method="POST">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>

                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>

                    <button type="submit">Reset Password</button>
                </form>
            </div>

    <?php
        } else {
            echo "<script>alert('The link is expired or invalid!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid request!'); window.location.href='index.php';</script>";
    }
    ?>
</body>
</html>
