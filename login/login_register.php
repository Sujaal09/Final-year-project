<?php
    require('database.php');
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    


function sendMail($email, $v_code) {
    require("PHPMailer/Exception.php");
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");

    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hotelblitz07@gmail.com';
        $mail->Password = 'fuwp akwu unwb txhy'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        
        $mail->setFrom('hotelblitz07@gmail.com', 'Hotel Blitz');
        $mail->addAddress($email);

        
        $mail->isHTML(true);
        $mail->Subject = 'Email verification from Hotel Blitz';
        $mail->Body = "Thank you for registering on our website. Please click the link to verify.
           <a href='http://localhost/login/verify.php?email=$email&v_code=$v_code'>Verify</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function send_Mail($email, $reset_token) {
    require("PHPMailer/Exception.php");
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");

    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hotelblitz07@gmail.com';
        $mail->Password = 'fuwp akwu unwb txhy'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        
        $mail->setFrom('hotelblitz07@gmail.com', 'Hotel Blitz');
        $mail->addAddress($email);

        
        $mail->isHTML(true);
        $mail->Subject = 'Email verification from Hotel Blitz';
        $mail->Body = "Please click the link to reset your password.
           <a href='http://localhost/login/updatepass.php?email=$email&token=$reset_token'>Reset password</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['login'])){
    $data = filteration($_POST);
    $res = select("SELECT * FROM `register_user` WHERE `email` = ?", [$data['email_user']], "s");

    if($res && mysqli_num_rows($res) == 1){
        $res_fetch = mysqli_fetch_assoc($res);
        if($res_fetch['verified'] == 1){
            if(password_verify($data['password'], $res_fetch['password'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['name'] = $res_fetch['name'];
                header("location: index.php");
            }else{
                echo "<script>alert('Login failed');</script>";

            }
        }else{
            echo "<script>alert('Please verify your email');</script>";

        }
    }else{
        echo "<script>alert('Login failed ');</script>";

    }
}


if(isset($_POST['register'])){
    $data = filteration($_POST);

    if($data['pass'] !== $data['cpass']){
        echo "<script>alert('Passwords do not match'); window.location.href='index.php';</script>";
        exit;

    }

    $u_exist = select("SELECT * FROM `register_user` WHERE email = ? OR phonenum = ? LIMIT 1", [$data['email'], $data['phonenum']], "ss");

    if(mysqli_num_rows($u_exist) != 0){
        echo "<script>alert('User already exists with email or phone'); window.location.href='index.php';</script>";
        exit;


    }else{
        $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);
        $v_code=bin2hex(random_bytes(16));
        $query = "INSERT INTO `register_user`(`name`, `email`, `phonenum`, `dob`, `password`,`v_code`, `verified`) VALUES (?, ?, ?, ?, ?, ?, '0')";
        $params = [$data['name'], $data['email'], $data['phonenum'], $data['dob'], $enc_pass,$v_code];

        if(insert($query, $params, "ssssss") && sendMail($_POST['email'],$v_code)) {
            echo "<script>alert('Registration successful. Please check your email'); window.location.href='index.php';</script>";

        }else{
            echo "<script>alert('Registration failed'); window.location.href='index.php';</script>";

        }
    }
}

if(isset($_POST['forgot'])){
    $query="SELECT * FROM `register_user` WHERE `email`='$_POST[email]'";
    $res=mysqli_query($con,$query);
    if($res){
        if(mysqli_num_rows($res)==1){
            $reset_token=bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Pokhara');
            $date=date("Y-m-d");
            $query="UPDATE `register_user` SET `token`='$reset_token',`t_expire`='$date' WHERE `email`='$_POST[email]'";
            if(mysqli_query($con,$query)&& send_Mail($_POST['email'],$reset_token)){
                echo "<script>alert('Password reset link sent to email!'); window.location.href='index.php';</script>";

    

            }else{
                echo "<script>alert('Server down!'); window.location.href='index.php';</script>";

            }

        }else{
            echo "<script>alert('Invalid email'); window.location.href='index.php';</script>";
        }

    }else{
        echo "<script>alert('Process failed'); window.location.href='index.php';</script>";

    }
}












?>
