<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    

    define('SITE_URL' , 'http://127.0.0.1/frontend/');
    define('FACILITY_IMG_PATH', SITE_URL.'images/facility/');
    define('ROOMS_IMG_PATH', SITE_URL.'images/rooms/');


    define( 'UPLOAD_IMAGE_PATH' ,$_SERVER['DOCUMENT_ROOT'] . '/frontend/images/');
    define('FACILITY_FOLDER', 'facility/');
    define('ROOMS_FOLDER', 'rooms/');




    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
            echo"
                <script>
                    window.location.href='index.php';
                </script>
            ";
        }
    }

    function redirect($url){
        echo"
            <script>
                window.location.href='$url';
            </script>
        ";

    }

    function alert($type, $message) {
        $bclass = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<alert
            <div class="alert $bclass alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$message</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    alert;
    }
    
    function uploadSVGImage($image, $folder){
        $valid_mime = ['image/svg+xml'];
        $img_mime = $image['type'];
    
        if (!in_array($img_mime, $valid_mime)) {
            return 'inv_img'; // Invalid image mime type
        } else if (($image['size'] / (1024 * 1024)) > 1) {
            return 'inv_size'; // Invalid size (greater than 1MB)
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";
    
            $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
            if (move_uploaded_file($image['tmp_name'], $img_path)) {
                return $rname; // Return the filename, not the full path
            } else {
                return 'upload_failed'; // Failed to upload the file
            }
        }
    }

    function uploadImage($image,$folder){
        $valid_mime = ['image/jpeg','image/png','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime, $valid_mime)){
            return 'inv_img'; //invalid image mime or format
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size'; //invalid size greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION) ;
            $rname = 'IMG_'.random_int(11111, 99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if (move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
    
    function deleteImage($image, $folder)
    {
            if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
                return true;
            }
            else{
                return false;
           }
    }




?>
