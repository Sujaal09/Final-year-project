<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <?php require('include/links.php');?>
</head>
<body class="bg-light">
    <?php require('include/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <hr>
    </div>
        <p class="text-center mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Atque aliquid unde ab voluptatem,<br> beatae corrupti perferendis 
            repellat provident reprehenderit velit aliquam tempora at, 
            molestias animi veniam officiis in nemo enim?
        </p>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-5 pz-4">
                    <div class="pop bg-white rounded shadow p-4">
                        <iframe class="w-100 rounded mb-4"   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112488.38821620736!2d83.9566183!3d28.2297224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995937bbf0376ff%3A0xf6cf823b25802164!2sPokhara!5e0!3m2!1sen!2snp!4v1739093133858!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <h5 class="mb-3">Call us</h5>
                        <a href="tel: +9779876453219" class="d-inline-block text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i>+9779876453219
                        </a>
                        <br>
                        <a href="tel: +9779789543261" class="d-inline-block text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i>+9779789543261
                        </a>
                        <h5 class="mt-4">Email</h5>
                        <a href="mailto: hotelblitz07@gmail.com"  class="d-inline-block text-decoration-none text-dark">
                            <i class="bi bi-envelope-fill"></i> hotelblitz07@gmail.com
                        </a>
                        <h5 class="mt-4">Follow us</h5>
                        <a href="#" class="d-inline-block text-dark text-decoration-none text-dark fs-5 me-2">
                            <i class="bi bi-facebook me-1"></i> 
                        </a> 
                        <a href="#" class="d-inline-block text-dark text-decoration-none text-dark fs-5 me-2">
                            <i class="bi bi-twitter-x me-1"></i>
                        </a>
                        <a href="#" class="d-inline-block text-dark fs-5 text-decoration-none text-dark">
                            <i class="bi bi-instagram me-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 pz-4">
                    <div class="bg-white rounded shadow p-4 ">
                        <form method="POST">
                            <h5>Send message</h5>
                            <div class="mt-3">
                                <label class="form-label" style="font-weight: 500;">Name</label>
                                <input name="name" required type="text" class="form-control shadow-none">
                            </div>
                            <div class="mt-3">
                                <label class="form-label" style="font-weight: 500;">Email</label>
                                <input name="email" required type="email" class="form-control shadow-none">
                            </div>
                            <div class="mt-3">
                                <label class="form-label" style="font-weight: 500;">Subject</label>
                                <input name="subject" required type="text" class="form-control shadow-none">
                            </div>
                            <div class="mt-3">
                                <label class="form-label" style="font-weight: 500;">Message</label>
                                <textarea name="message" required class="form-control shadow-none" rows="4" style="resize: none"></textarea>
                            </div>
                            <button type="submit" name="send" class="btn mt-3 text-white custom-bg">Submit</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>     
    </div>

    <?php
        if(isset($_POST['send'])){
            $frm_data=filteration($_POST);
            $query ="INSERT INTO `contact_form`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];
            $result= insert($query,$values,'ssss');
            if($result==1){
                alert('success','Message sent');
            }else{
                alert('error','Server down');
            }
        }
    ?>


    <?php require('include/footer.php'); ?>








 
</body>
</html>