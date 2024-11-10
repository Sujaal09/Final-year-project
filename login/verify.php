<?php
    require('database.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(isset($_GET['email']) && isset($_GET['v_code'])){
        $email = $_GET['email'];
        $v_code = $_GET['v_code'];
        
        $query = "SELECT * FROM `register_user` WHERE `email` = ? AND `v_code` = ?";
        $res = select($query, [$email, $v_code], "ss");
    
        if ($res && $res->num_rows == 1){
            $res_fetch = $res->fetch_assoc();
            if ($res_fetch['verified'] == 0){ //to check if the email is verified or not
                $update = "UPDATE `register_user` SET `verified` = 1 WHERE `email` = ?";
                if (insert($update, [$email], "s")){
                        echo "<script>alert('Verification successful'); window.location.href='index.php';</script>";

                    }else{
                        echo "<script>alert('Unable to run query '); window.location.href='index.php';</script>";
                    }

                }else{
                    echo "<script>alert('Email already registered'); window.location.href='index.php';</script>";

                }
            }

        }else{
            echo "<script>alert('Unable to run query'); window.location.href='index.php';</script>";

    }


?>