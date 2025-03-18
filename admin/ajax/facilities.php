<?php


    require('../include/database.php');
    require('../include/essential.php');
    adminLogin();


    if(isset($_POST['add_facility'])){
        $frm_data = filteration($_POST);
        $img_r = uploadSVGImage($_FILES['icon'], FACILITY_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }else if($img_r =='inv_size'){
            echo $img_r;
        }else if($img_r =='upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `facility`(`icon`,`name`,`description`) VALUES (?,?,?)";
            $values = [$img_r,$frm_data['name'],$frm_data['description']];
            $res = insert($q, $values, 'sss');
            echo $res;
        }
        exit();
    }

    if(isset($_POST['get_facilities'])){
        $res = selectAll('facility');
        $i=1;
        $path= FACILITY_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
            echo <<<data
            <tr class="align-middle">
                <td>$i</td>
                <td><img src="$path$row[icon]" width="100px"></td>
                <td>$row[name]</td>
                <td>$row[description]</td>
                <td>
                    <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </td>
            </tr>
            data; 
            $i++;
        }
        exit();

    }

    if (isset($_POST['rem_facility'])) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_facility']];

        $check_q = select('SELECT * FROM `room_facility` WHERE `facility_id`=?',[$frm_data['rem_facility']],'i');

        if(mysqli_num_rows($check_q)==0){
            $pre_q = "SELECT * FROM `facility` WHERE `id`=?" ;
            $res = select($pre_q, $values, 'i');
            $img = mysqli_fetch_assoc($res);
    
    
            if(deleteImage($img['icon'], FACILITY_FOLDER)){
                $q = "DELETE FROM `facility` WHERE `id` = ?";
                $res = delete($q, $values, 'i');
                echo $res;
            }else{
                echo 0;
            }
        }else{
            echo 'room_added';
        }
        exit();
    }
    




?>