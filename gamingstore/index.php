<?php

session_start();

require 'config.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Gaming store</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--google font-->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <!--font awesome-->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <!--my css-->
    <link rel="stylesheet" type="text/css" href="css/style.css">



</head>

<body>

    <header>

        <div class="navbar">
            <h4>Games Store</h4>
            <ul class=" nav justify-content-end">

                <?php
                if (isset($_SESSION["email"])) {
                ?>

                    <h6>Hi - <?php echo $_SESSION['email']; ?></h6>
                    <a href="#" id="logout">logout</a>

                <?php
                } else {
                ?>

                    <li class="nav-item">
                        <button class="btn btn-success" href="#" name="login" id="login" data-toggle="modal" data-target="#loginmodal">Login</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-success" href="#" name="signup" id="signup" data-toggle="modal" data-target="#signupmodal">Signup</button>
                    </li>

                <?php
                }
                ?>
            </ul>
        </div>

    </header>


    <h3 class="text-center ">My Shop</h3>
    <ul class="nav justify-content-end">
        <li class="nav-item ">
            <a class="nav-link" href="checkout.php">Chekout</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i>Cart<span id="cart-item" class="badge badge-danger"></span></a>
        </li>
    </ul>
    <br>
    <br>

    <div class="container-fluid">
        <!--<div id="message"></div>-->
        <div class="row">
            <div class="col-lg-3">
                <h5>Filter Products</h5>
                <hr color="white">
                <h6 class="text-info">Select type</h6>
                <ul class="list-group">
                    <?php
                    $sql = "SELECT DISTINCT product_type FROM product ORDER BY product_type";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input product_check" value="<?= $row['product_type']; ?>" id="product_type"><?= $row['product_type']; ?>

                                </label>
                            </div>

                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="col-lg-9">
                <h5 class="text-center" id="textChange">All Products</h5>
                <hr color="white">
                <div class="text-center">
                    <img src="img/loader.svg" id="loader" width="150" style="display:none;">
                </div>

                <div class="row" id="result">
                    <?php
                    $sql = "SELECT * FROM product";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col-sm-6 col-md-3 col-lg-3 mb-2">
                            <div class="card-deck ">
                                <div class="card p-2 border-secondary mb-2">
                                    <img src="<?= $row['product_image']; ?>" class="card-img-top" height="400px">
                                    <div class="card-body text-center p-3">
                                        <h6 class="card-title bg-danger text-center rounded p-1 "><?= $row['product_name']; ?></h6>
                                        <h4 class="card-text text-center text-danger">Price :&nbsp;&nbsp;<i class="fas fa-rupee-sign"></i> <?= number_format($row['product_price']); ?>/-</h4>
                                    </div>
                                    <div class="card-footer p-2">
                                        <form action="" class="form-submit">
                                            <input type="hidden" class="product_id" value="<?= $row['product_id'] ?>">
                                            <input type="hidden" class="product_name" value="<?= $row['product_name'] ?>">
                                            <input type="hidden" class="product_type" value="<?= $row['product_type'] ?>">
                                            <input type="hidden" class="product_price" value="<?= $row['product_price'] ?>">
                                            <input type="hidden" class="product_image" value="<?= $row['product_image'] ?>">
                                            <input type="hidden" class="product_code" value="<?= $row['product_code'] ?>">
                                            <button class="btn btn-success btn-block addItemBtn"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add To Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="loginmodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>LogIn</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <!--<form id="myform"  action="login.php" method="post" >-->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="link forget-pass text-left">
                        <a href="forgot-password.php">Forgot password?</a>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="button" name="login_button" id="login_button">Sign in</button>
                    </div>
                    <div class="link login-link text-center">Not yet a member?
                        <a href="signup-user.php">Signup now</a>
                    </div>
                    <!--</form>-->

                </div>

                <div class="modal-footer">
                    <a>good day</a>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="signupmodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>SignUp</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form id="myformRegister" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" id="address" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="button" id="signup_button">Register</button>
                        </div>
                </div>
                </form>
            </div>

            <div class="modal-footer">
                <a>good day</a>
            </div>


        </div>
    </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $('#signup_button').click(function() {

                var formData = new FormData($('#myformRegister')[0]);

                if (formData.get('name') != '' && formData.get('email') != '' && formData.get('address') != '' && formData.get('password') != '') {
                    $.ajax({
                        url: "signup.php",
                        method: "POST",
                        data: {
                            name: formData.get('name'),
                            email: formData.get('email'),
                            address: formData.get('address'),
                            password: formData.get('password')
                        },
                        success: function(data) {
                            if (data == 'No') {
                                alert("incomplete data");
                            } else {
                                $('#signupmodal').hide();
                                location.reload();
                                alert("you have successfully signed up! Login to start shopping");
                            }

                        }
                    });
                } else {
                    alert("Incomplete Data");
                }
            });


            $('#login_button').click(function() {
                var email = $('#email').val();
                var password = $('#password').val();
                if (email != '' && password != '') {
                    $.ajax({
                        url: "login.php",
                        method: "POST",
                        data: {
                            email: email,
                            password: password
                        },
                        success: function(data) {
                            if (data == 'No') {
                                location.reload();
                                alert("Wrong Data");

                            } else {
                                $('#loginmodal').hide();
                                location.reload();
                                alert("have fun shopping!");
                            }

                        }
                    });


                } else {
                    alert("Both fields are required");
                }
            });

            $("#logout").click(function() {
                var action = "logout";
                $.ajax({
                    url: "logout.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function(data) {
                        location.reload();
                    }


                })
            });

            $(".product_check").click(function() {
                $("#loader").show();

                var action = 'data';
                var product_type = get_filter_text('product_type');

                $.ajax({

                    url: "action.php",
                    method: "POST",
                    data: {
                        action: action,
                        product_type: product_type
                    },
                    success: function(response) {
                        $("#result").html(response);
                        $("#loader").hide();
                        $("#textChange").text("Filtered Products");

                    }

                });

            });

            function get_filter_text(text_id) {
                var filterData = [];
                $('#' + text_id + ':checked').each(function() {
                    filterData.push($(this).val());
                });
                return filterData;
            }

            $(".addItemBtn").click(function(e) {
                e.preventDefault();

                var $form = $(this).closest(".form-submit");
                var product_id = $form.find(".product_id").val();
                var product_name = $form.find(".product_name").val();
                var product_type = $form.find(".product_type").val();
                var product_price = $form.find(".product_price").val();
                var product_image = $form.find(".product_image").val();
                var product_code = $form.find(".product_code").val();

                $.ajax({

                    url: 'addtocart.php',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        product_name: product_name,
                        product_type: product_type,
                        product_price: product_price,
                        product_image: product_image,
                        product_code: product_code
                    },
                    success: function(response) {
                        if (response == 'no') {
                            alert("Item already in cart!");
                        } else {
                            alert("Item added to cart!");
                            load_cart_item_number();
                        }
                        /*
                        $("#message").html(response);
                        load_cart_item_number();
                        */


                    }

                });
            });

            load_cart_item_number();

            function load_cart_item_number() {

                $.ajax({
                    url: 'addtocart.php',
                    method: 'GET',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                });

            }

        });
    </script>


</body>

</html>