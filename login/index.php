<?php 
    require("database.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Blitz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .h-font { font-family: 'Merienda', cursive; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Hotel Blitz</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Facilities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                </ul>
                <div class="d-flex">
                    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <span class="navbar-text me-3">Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>!</span>
                        <a href="logout.php" class="btn btn-outline-dark">Logout</a>
                    <?php else: ?>
                        <button class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                        <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="login_register.php">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-person"></i> Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Email address</label>
                            <input type="email" name="email_user" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none" name="login">LOGIN</button>
                        <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0"  data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">Forgot Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="POST" action="login_register.php">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>Registration </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                Note: Please fill out all the required fields.
                            </span>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Name</label>
                                        <input  name="name" type="text" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <label class="form-label">Email </label>
                                        <input name="email" type="email" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input name="phonenum" type="number" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label">Date of birth </label>
                                        <input name="dob" type="date" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Password </label>
                                        <input name="pass" type="password" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label">Confirm Password </label>
                                        <input name="cpass" type="password" class="form-control shadow-none" required>
                                    </div>    
                                </div>
                            </div>
                            <div class="text-center my-1">
                                <button type="submit" class="btn btn-dark shadow-none" name="register">REGISTER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="forgotModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="login_register.php">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-person"></i> Forgot Password</h5>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    Note: Reset link will be sent to your email!
                        </span>
                        <div class="mb-4">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="text-end mb-2">
                            <button type="button" class="btn shadow-none me-2"  data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark shadow-none" name="forgot">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
            echo "<h1 style='text-align:center; margin-top:300px;'> Welcome - " . htmlspecialchars($_SESSION['name']) . "</h1>";
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






