<?php 


    require('include/essential.php');
    require('include/database.php');
    adminLogin();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel - Facilities</title>
    <link rel="stylesheet" href="css/style.css">
    <?php require('include/links.php');?>
</head>

<body class="bg-light">

    <?php require('include/header.php'); ?>




    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">FACILITIES</h3>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-md" style="height:450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="text-light" style="background: linear-gradient(135deg, #004d99, #00bcd4);">
                                    <th scope="col">#</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" width="40%">Description</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    <!-- modal -->
    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Facility</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input  name="facility_name" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <input type="file" name="facility_icon"  accept=".svg" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="facility_description"  class="form-control shadow-none" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary text-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">Save</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    




    <?php require('include/scripts.php');?>
    <script src="scripts/facilities.js"></script>

    
</body>
</html>