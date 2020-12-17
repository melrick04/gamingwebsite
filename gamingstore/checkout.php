<?php

session_start();
require 'config.php';

$grand_total = 0;
$allItems = '';
$items = array();

$sql = "SELECT CONCAT(product_name , '(' ,product_quantity, ')'  ) AS ItemQuantity , total_price FROM cart ";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result =  $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQuantity'];
}
$allItems = implode(",", $items);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout!</title>

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

        </div>

    </header>



    <ul class="nav justify-content-end">
        <li class="nav-item ">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link active" href="product.php">Products</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i>Cart<span id="cart-item" class="badge badge-danger"></span></a>
        </li>
    </ul>
    <br>
    <br>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h4 class="text-center text-info p-2">Payment</h4>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h5 class="lead"><b style="color: purple;">Product(s) :&nbsp;&nbsp;</b> <?= $allItems; ?></h5>
                    <h5 class="lead"><b style="color: purple;">Shipping Charges : </b>Free</h5>
                    <h5 class="lead"><b style="color: purple;">Amount Payable:&nbsp;&nbsp;</b> <?= number_format($grand_total); ?></h5>
                </div>
                <form action="" method="post" id="placeOrder">
                    <input type="hidden" name="products" value="<?= $allItems; ?>">
                    <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Customer Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="contact" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control" rows="4" placeholder="Enter Delivery Address!" required></textarea>
                    </div>

                    <h6 class="text-left lead">Select Payment Mode</h6>
                    <div class="form-group">
                        <select name="paymentmode" class="form-control">
                            <option value="" selected disabled>Select Payment Mode</option>
                            <option value="cod">Cash On Delivery</option>
                            <option value="card">Card Payment</option>
                            <option value="netbanking">Net Banking</option>
                            <option value="upi">UPI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-block btn-success <?= ($grand_total > 1) ? "" : "disabled"; ?>" type="submit" name="submit" value="Confirm Order!">
                    </div>

            </div>

            </form>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $("#placeOrder").submit(function(e) {
                e.preventDefault();

                $.ajax({

                    url: 'action.php',
                    method: 'POST',
                    data: $('form').serialize() + "&action=order",
                    success: function(response) {
                        $("#order").html(response);
                    }

                });


            });


            load_cart_item_number();

            function load_cart_item_number() {

                $.ajax({
                    url: 'action.php',
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