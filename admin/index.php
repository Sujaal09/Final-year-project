<?php
    require('include/essential.php');
    require('include/database.php');


    session_start();
    if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
       redirect('dashboard.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel
    </title>
    <?php require('include/links.php');?>
    <style>
        div.login-form{
            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            width: 350px;

        }
    </style>
</head>
<body class = "bg-light">

    <div class ="login-form text-center bg-white  shadow overflow-hidden">
        <form method="POST">
            <h4 class="custom-bg text-black py-3">ADMIN LOGIN</h4>
            <div class= "p-3">
                <div class="mb-3">
                    <input name="admin_name" required  type="text" class="form-control shadow-none text-center" placeholder = "Admin Name">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <button name="login" type="submit" class= "btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <?php
        if(isset($_POST['login'])){

            $f_data = filteration($_POST); // filteration function is called after button is clicked
            $query = "SELECT * FROM `admin` WHERE `admin_name`=? AND `admin_pass`=?";
            $value=[$f_data['admin_name'],$f_data['admin_pass']]; // values are stored in array

            $result=select($query,$value,"ss");      // select function is called where query values and datatypes are passed
            if($result->num_rows==1){
                $row = mysqli_fetch_assoc($result);
                $_SESSION['adminLogin']= true;
                $_SESSION['adminId']=$row['s_n'];
                redirect('dashboard.php');
            }else{
                alert('error','Login failed');
            
            }


        }
    
    
    
    
    ?>






<?php require('include/scripts.php');?>







</body>
</html>