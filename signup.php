
<?php
session_start();


        if (isset($_SESSION['signup_error'])) {
            echo '<p class="text-danger text-center pt-2">' . $_SESSION['signup_error'] . '</p>';
            unset($_SESSION['signup_error']);
        }
        ?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid px-1 py-5 mx-auto">


    <div class="container">
      
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <div class="card">
                <h5 class="text-center mb-4">Welcome, signup</h5>
                <form class="form-card"  action="signupUser.php" method="POST">





                    <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Name<span class="text-danger"> *</span></label> <input type="text" id="name" name="username" placeholder="Enter your  name" onblur="validate(1)"> </div>

                    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label> <input type="text" id="email" name="email" placeholder="Enter your email" onblur="validate(2)"> </div>

                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Gender<span class="text-danger"> *</span></label> <input type="text" id="email" name="gender" placeholder="" onblur="validate(3)"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Phone number<span class="text-danger"> *</span></label> <input type="text" id="mob" name="phone" placeholder="" onblur="validate(4)"> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">occupation<span class="text-danger"> *</span></label> <input type="text" id="job" name="occupation" placeholder="" onblur="validate(5)"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">password<span class="text-danger"> *</span></label> <input type="text" id="password" name="password" placeholder="Enter your password" onblur="validate(2)"> </div>

                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex"> <label class="form-control-label px-3">Address<span class="text-danger"> *</span></label> <input type="text" id="ans" name="address" placeholder="" onblur="validate(6)"> </div>
                    </div>
                    <div class="row w-100 justify-content-center">
                    <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">signup</button> </div>

                    </div>
                    <div>
                        or
                    </div>
                    <a href="./index.php">login</a>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>