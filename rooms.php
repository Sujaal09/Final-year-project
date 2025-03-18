<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <?php require('include/links.php');?>
</head>
<body class="bg-light">
    <?php require('include/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <hr>
    </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 px-0">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                        <div class="container-fluid flex-lg-column align-items-stretch">
                            <h4 class="mt-2">FILTERS</h4>
                            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterDropdown">
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                    <label class="form-label">Check-in</label>
                                    <input type="date" type="date" class="form-control shadow-none mb-3" >
                                    <label class="form-label">Check-out</label>
                                    <input type="date" type="date" class="form-control shadow-none" >  
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f1" type="date" class="form-check-input shadow-none me-1" >
                                        <label class="form-check-label" for="f1">Facility one</label>
                                    </div> 
                                    <div class="mb-2">
                                        <input type="checkbox" id="f2" type="date" class="form-check-input shadow-none me-1" >
                                        <label class="form-check-label" for="f2">Facility two</label>
                                    </div> 
                                    <div class="mb-2">
                                        <input type="checkbox" id="f3" type="date" class="form-check-input shadow-none me-1" >
                                        <label class="form-check-label" for="f3">Facility three</label>
                                    </div> 
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <label class="form-label">Adults</label>
                                            <input type="number" type="date" class="form-control shadow-none" >
                                        </div>
                                        <div>
                                            <label class="form-label">Childrens</label>
                                            <input type="number" type="date" class="form-control shadow-none" >
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-9 col-md-12 ps-4">
                    <?php
                        $room_res=select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?",[1,0],'ii');
                        while($room_data = mysqli_fetch_assoc(($room_res))){

                            // get facility of room

                            $fac_q = mysqli_query($con,"SELECT f.name FROM `facility` f INNER JOIN `room_facility` rfac ON f.id= rfac.facility_id WHERE rfac.room_id='$room_data[id]'");
                            $facilities_data = "";
                            while($fac_row = mysqli_fetch_assoc($fac_q)){
                                $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                    $fac_row[name]
                                </span>";
                            }

                            // get thumbnail of image

                            $room_thumb = ROOMS_IMG_PATH."ethumbnail.png";
                            $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                            if(mysqli_num_rows($thumb_q)>0){
                                $thumb_res = mysqli_fetch_assoc($thumb_q);
                                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                            }

                            // printing room card

                            echo <<<data
                                <div class="card mb-4 border-0 shadow">
                                    <div class="row g-0 p-3 align-items-center">
                                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                            <img src="$room_thumb" class="img-fluid rounded">
                                        </div>
                                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                            <h5 class="mb-3">$room_data[name]</h5>
                                            <div class="facilities mb-3">
                                                <h6 class="mb-1">Facilities</h6>
                                                $facilities_data
                                            </div>
                                            <div class="guests mb-3">
                                                <h6 class="mb-1">Guests</h6>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                    $room_data[adult] Adults
                                                </span>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                    $room_data[children] Children
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-align-center">
                                            <h6 class="mb-4">Rs $room_data[price] per night</h6>
                                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none mb-2 w-100">Book Now</a>
                                            <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none w-100">More details</a>        
                                        </div>
                                    </div>
                                </div>
                            data;
                        }             
                    ?>


                    
                    
                </div>
                
            </div>
        </div>

        
    </div>


    <?php require('include/footer.php'); ?>








 
</body>
</html>