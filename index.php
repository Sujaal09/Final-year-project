<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php require('include/links.php');?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>


    <style>
        .availability-form{
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
        @media screen and (max-width: 575px) {
            .availability-form{
                margin-top: 25px;
                padding:0 35px
            }    
        }
    </style>
</head>
<body class="bg-light">
    <?php require('include/header.php'); ?>
<!-- Carousel -->
    <div class="container-fluid pz-lg-4 mt-4">
        <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                <img src="images/carousel/1.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                <img src="images/carousel/2.png" class="w-100 d-block" />
                </div>
            </div>
        </div>
    </div>

<!-- Check availability form -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label"style="font-weight:500;">Check-in</label>
                            <input type="date" type="date" class="form-control shadow-none" >
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label"style="font-weight:500;">Check-out</label>
                            <input type="date" type="date" class="form-control shadow-none" >
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label"style="font-weight:500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label"style="font-weight:500;">Children</label>
                            <select class="form-select shadow-none">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-3">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



<!-- Our Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
            <?php
                $room_res=select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');
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
                        <div class="col-lg-4 col-md-6 my-3">
                            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                <img src="$room_thumb" class="card-img-top">
                                <div class="card-body">
                                    <h5>$room_data[name]</h5>
                                    <h6 class="mb-4">Rs $room_data[price] per night</h6>
                                    <div class="facilities mb-4">
                                        <h6 class="mb-1">Facilities</h6>
                                        $facilities_data
                                    </div>
                                    <div class="guests mb-4">
                                        <h6 class="mb-1">Guest</h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            $room_data[adult] Adults
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            $room_data[children] Children
                                    </div>
                                    <div class="rating mb-4">
                                    <h6 class="mb-1">Rating</h6>
                                    <span class="badge rounded bg-light">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                    

                                    </div>
                                    <div class="d-flex justify-content-evenly mb-2">
                                        <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                                        <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    data;
                }             
            ?>
            
            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
            </div>
        </div>
    </div>

<!-- Facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <?php
                $res = mysqli_query($con,"SELECT * FROM `facility` ORDER BY `id` DESC LIMIT 4 ");
                $path= FACILITY_IMG_PATH;

                while($row= mysqli_fetch_assoc($res)){
                    echo <<<data
                        <div class="col-lg-2 col-md-2  text-center bg-white rounded shadow my-3 py-4">
                            <img src="$path$row[icon]" width="60px">
                            <h5 class="mt-3">$row[name]</h5>
                        </div>
                    data;
                }
            ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
            </div>
        </div>
    </div>

<!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
    <div class="container">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images" width=""/>
                        <h6 class="m-0 ms-2">User1</h6>
                    </div>
                    <p>
                        a b b b b b b b  s  d a  sd asd
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images" width=""/>
                        <h6 class="m-0 ms-2">User1</h6>
                    </div>
                    <p>
                        a b b b b b b b  s  d a  sd asda b b b b b b b  s  d a  sd asda b b b b b b b  s  d a  sd asd
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images" width=""/>
                        <h6 class="m-0 ms-2">User1</h6>
                    </div>
                    <p>
                        a b b b b b b b  s  d a  sd asda b b b b b b b  s  d a  sd asda b b b b b b b  s  d a  sd asd
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images" width=""/>
                        <h6 class="m-0 ms-2">User1</h6>
                    </div>
                    <p>
                        a b b b b b b b  s  d a  sd asda b b b b b b b  s  d a  sd asda b b b b b b b  s  d a  sd asd
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More details >>></a>
        </div>
    </div>

    <?php require('include/footer.php'); ?>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
      var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        effect: "fade",
        loop:true,
        autoplay: {
            delay: 3000,
        }
      });
      var swiper = new Swiper('.swiper-testimonials', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      slidesPerView:"3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: '.swiper-pagination',
      },
      breakpoints: {
        320: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
      }
      });
    </script>


 
</body>
</html>