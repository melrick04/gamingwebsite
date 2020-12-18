<?php

session_start();

require 'config.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>

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
            <a href="index.php">
                <img src="img/logo.jpg" id="logo">
            </a>
            <ul class=" nav justify-content-end">

                <?php
                if (isset($_SESSION["email"])) {
                ?>

                    <h6>Hi - <?php echo $_SESSION['email']; ?></h6>
                    <a href="#" id="logout">&nbsp;&nbsp; logout</a>
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




    <ul class="nav justify-content-end">
        <li class="nav-item ">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="product.php">Products</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link active" href="cart.php"><i class="fas fa-shopping-cart"></i>Cart<span id="cart-item" class="badge badge-danger"></span></a>
        </li>
    </ul>
    <hr color="white" width="96%">
    <br>
    <br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div style="display:<?php if (isset($_SESSION['notification'])) {
                                        echo $_SESSION['notification'];
                                    } else {
                                        echo 'none';
                                    }
                                    unset($_SESSION['notification']); ?>" class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?php if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            }
                            unset($_SESSION['notification']); ?></strong>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td colspan="10" style="background-color: black;">
                                    <h4 class="text-center text-success m-0">Products in Cart!</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Game Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" onclick="return confirm('Do you wanna clear your cart?')" class="badge badge-danger p-2"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart!</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'config.php';

                            $stmt = $conn->prepare("SELECT * FROM cart");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while ($row = $result->fetch_assoc()) :
                            ?>
                                <tr>
                                    <td><?= $row['cart_id'] ?></td>
                                    <input type="hidden" class="cart_id" value="<?= $row['cart_id'] ?>">
                                    <td><?= $row['product_name'] ?></td>
                                    <td><img height="100px" src="<?= $row['product_image']; ?>"></td>
                                    <td><?= $row['product_type']; ?></td>
                                    <td><i class="fas fa-rupee-sign"></i>&nbsp;<?= number_format($row['product_price']); ?></td>
                                    <input type="hidden" class="product_price" value="<?= $row['product_price'] ?>">
                                    <td><input type="number" min="1" class="form-control itemqty" value="<?= $row['product_quantity']; ?>" style="width: 75px;"></td>
                                    <td><i class="fas fa-rupee-sign"></i>&nbsp;<?= number_format($row['total_price']); ?></td>
                                    <td>
                                        <a href="action.php?remove=<?= $row['cart_id']; ?>" onclick="return confirm('Do you want to remove the item from your cart?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php $grand_total += $row['total_price']; ?>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="4">
                                    <a href="product.php" class="btn btn-warning"><i class="fas fa-cart-plus">&nbsp;&nbsp;&nbsp;</i>Continue Shopping!</a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td><b><i class="fas fa-rupee-sign"></i>&nbsp;<?= number_format($grand_total); ?></b></td>
                                <td>
                                    <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? "" : "disabled"; ?>"><i class="fas fa-credit-card">&nbsp;</i>Checkout!</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

                <div class="modal-body" style="color: black;">

                    <div class="form-group">
                        <label>Email</label>
                        <br>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <br>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="link forget-pass text-left">
                        <a href="forgot-password.php">Forgot password?</a>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger btn-block" type="button" name="login_button" id="login_button">Sign in</button>
                    </div>
                    <div class="link login-link text-center" style="color:black">Not yet a member?
                        <a href="signup-user.php">Signup now</a>
                    </div>


                </div>

                <div class="modal-footer">
                    <h6>Welcome Back</h6>
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

                <div class="modal-body" style="color: black;">
                    <form id="myformRegister" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <br>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <br>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <br>
                            <input type="text" name="address" id="address" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <br>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger btn-block" type="button" id="signup_button">Register</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <h6>Let's Get Started!</h6>
                </div>


            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

    <div id="foot">
        <div class="footer">
            <div class="section">
                <ul class="nav justify-content-right">
                    <li>
                        <h6><i class="fab fa-cc-visa fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                    </li>
                    <li>
                        <h6><i class="fab fa-cc-paypal fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                    </li>
                    <li>
                        <h6><i class="fab fa-cc-mastercard fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                    </li>
                    <li>
                        <h6><i class="fab fa-cc-amazon-pay fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                    </li>
                    <li>
                        <h6>and 200<i class="fas fa-plus fa-xs"></i>&nbsp;&nbsp;more</h6>
                    </li>
                </ul>
                <hr>
            </div>

            <div class="footer-content">

                <div class="footer-section">
                    <h5>About Us</h5>
                    <br>
                    <p>Bringing you the latest and exlusive games with the best possible deals</p>

                </div>

                <div class="footer-section">
                    <h5>Contact Us</h5>
                    <br>
                    <div class="contact">
                        <span><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;8668612283</span>
                        <br>
                        <span><i class="far fa-envelope"></i>&nbsp;&nbsp;melrick1611@hotmail.com<br></span>

                        <br>
                        <a href="#"><i class="fab fa-facebook fa-lg"></i>&nbsp;&nbsp;</a>
                        <a href="#"><i class="fab fa-instagram fa-lg"></i>&nbsp;&nbsp;</a>
                        <a href="#"><i class="fab fa-twitter fa-lg"></i>&nbsp;&nbsp;</a>
                        <a href="#"><i class="fab fa-youtube fa-lg"></i>&nbsp;&nbsp;</a>
                    </div>

                </div>
                <div class="footer-section">
                    <h5>Download the App<h5>
                            <br>
                            <div class="download">
                                <a href="#"><i class="fab fa-google-play fa-lg">&nbsp;Google Play&nbsp;&nbsp;</i></a>
                                <a href="#"><i class="fab fa-apple fa-lg">&nbsp;Apple Store&nbsp;&nbsp;</i></a>

                            </div>
                </div>
            </div>

            <div class="footer-bottom ">
                &copy;coderick
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

            $(".itemqty").on('change', function() {
                var $el = $(this).closest('tr');

                var cart_id = $el.find(".cart_id").val();
                var product_price = $el.find(".product_price").val();
                var itemqty = $el.find(".itemqty").val();
                location.reload(true);
                $.ajax({

                    url: 'action.php',
                    method: 'POST',
                    cache: false,
                    data: {
                        itemqty: itemqty,
                        cart_id: cart_id,
                        product_price: product_price,

                    },
                    success: function(response) {

                        console.log(response);

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