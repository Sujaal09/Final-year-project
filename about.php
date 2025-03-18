<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('include/links.php');?>
    <style>
        .box{
            border-top-color: var(--teal) !important ;
        }
    </style>
</head>
<body class="bg-light">
    <?php require('include/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <hr>
    </div>
        <p class="text-center mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Atque aliquid unde ab voluptatem,<br> beatae corrupti perferendis 
            repellat provident reprehenderit velit aliquam tempora at, 
            molestias animi veniam officiis in nemo enim?
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-2">
                <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Aliquam, dolor.
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-1">
                <img src="images/about/" class="w-100">

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/" width="70px">
                    <h4 class="mt-3">50+ ROOMS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/" width="70px">
                    <h4 class="mt-3">70+ REVIEWS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/" width="70px">
                    <h4 class="mt-3">100+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/" width="70px">
                    <h4 class="mt-3">100+ STAFFS</h4>
                </div>
            </div>
        </div>
    </div>

    


    <?php require('include/footer.php'); ?>








 
</body>
</html>