<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <?php require('include/links.php');?>
    <style>
        .pop:hover{
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>
<body class="bg-light">
    <?php require('include/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <hr>
    </div>
        <p class="text-center mt-3">Experience comfort and convenience with our top-notch facilities<br> 
             designed to make your stay relaxing and enjoyable
        </p>

        <div class="container">
            <div class="row">
                <?php
                    $res = selectAll('facility');
                    $path= FACILITY_IMG_PATH;

                    while($row= mysqli_fetch_assoc($res)){
                        echo <<<data
                            <div class="col-lg-4 col-md-6 mb-5 pz-4">
                                <div class="pop bg-white rounded shadow p-4 border-top border-4 border-dark">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="$path$row[icon]" width="40px">
                                        <h5 class="m-0 ms-3">$row[name]</h5>
                                    </div>
                                    <p>$row[description]</p>
                                </div>
                            </div>
                        data;
                    }
                
                ?>
            </div>
        </div>

        
    </div>


    <?php require('include/footer.php'); ?>








 
</body>
</html>