<?php

require 'config.php';


if (isset($_POST['filter'])) {
    $sql = " SELECT * FROM product WHERE product_type !='' ";

    if (isset($_POST['product_type'])) {
        $product_type = implode("','", $_POST['product_type']);
        $sql .= "AND product_type IN('" . $product_type . "')";
    }

    if (isset($_POST['genre'])) {
        $genre = implode("','", $_POST['genre']);
        $sql .= "AND genre IN('" . $genre . "')";
    }

    $result = $conn->query($sql);
    $output = '';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '<div class="col-sm-6 col-md-3 col-lg-3 mb-2">
            <div class="card-deck ">
                <div class="card p-2 border-secondary mb-2">
                    <img src="' . $row['product_image'] . '" class="card-img-top" height="400px">
                    <div class="card-body text-center p-3">
                    <h6 class="card-title bg-danger text-center rounded p-1 ">' . $row['product_name'] . '</h6>
                    <h6 class="card-text text-left text-info">Game Type:&nbsp;&nbsp;' . $row['product_type'] . '</h6>
                    <h5 class="card-text text-left text-info">Price :&nbsp;&nbsp;<i class="fas fa-rupee-sign"></i> ' . number_format($row['product_price']) . '/-</h5>
                    </div>
                    <div class="card-footer p-2">
                         <form action="" class="form-submit">
                            <input type="hidden" class="product_id" value="' . $row['product_id'] . '">
                            <input type="hidden" class="product_name" value="' . $row['product_name'] . '">
                            <input type="hidden" class="product_type" value="' . $row['product_type'] . '">
                            <input type="hidden" class="product_price" value="' . $row['product_price'] . '">
                            <input type="hidden" class="product_image" value="' . $row['product_image'] . '">
                            <input type="hidden" class="product_code" value="' . $row['product_code'] . '">
                            <button class="btn btn-success btn-block addItemBtn"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
        }
    } else {
        $output = "<h3>No Products Found!</h3>";
    }
    echo $output;
}


if (isset($_POST['product_id'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_code = $_POST['product_code'];
    $product_quantity = 1;

    $stmt = $conn->prepare("SELECT product_code FROM cart WHERE product_code=? ");
    $stmt->bind_param("s", $product_code);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['product_code'];
    if (!$code) {
        $query = $conn->prepare("INSERT INTO cart (product_name,product_type,product_price,product_image,product_quantity,total_price,product_code) VALUES (?,?,?,?,?,?,?) ");
        $query->bind_param("ssssiss", $product_name, $product_type, $product_price, $product_image, $product_quantity, $product_price, $product_code);
        $query->execute();

        echo 'yes';
    } else {

        echo 'no';
    }
}

if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $conn->prepare("SELECT * FROM cart");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;


    echo $rows;
}

if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id=?");
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();

    $_SESSION['notification'] = 'block';
    $_SESSION['message'] = 'Item removed!';
    header('location:cart.php');
}

if (isset($_GET['clear'])) {

    $stmt = $conn->prepare("DELETE FROM cart");
    $stmt->execute();
    $_SESSION['notification'] = 'block';
    $_SESSION['message'] = 'Cart is emptied';
    header('location:cart.php');
}

if (isset($_POST['itemqty'])) {

    $itemqty = $_POST['itemqty'];
    $cart_id = $_POST['cart_id'];
    $product_price = $_POST['product_price'];

    $total_price = $itemqty * $product_price;

    $stmt = $conn->prepare("UPDATE cart SET product_quantity=?, total_price=? WHERE cart_id=?");
    $stmt->bind_param('isi', $itemqty, $total_price, $cart_id);
    $stmt->execute();
}


if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $paymentmode = $_POST['paymentmode'];

    $data = '';

    $stmt = $conn->prepare("INSERT INTO orders (name,email,contact,address,paymentmode,products,amount_paid) VALUES(?,?,?,?,?,?,?) ");
    $stmt->bind_param("sssssss", $name, $email, $contact, $address, $paymentmode, $products, $grand_total);
    $stmt->execute();

    $data .= '<div class="text-center">
                <h1 class="display-4 mt-2 text-success">Thanks For Shopping With Us!</h1>
                <h2 class="text-success"> Order placed successfully!</h2>
                <br>
                <h3 class="text-success text-center"> Order Summary</h3>
                <h4 class="bg-info text-light round p-2 ">Purchased Items : ' . $products . '</h4>
                <h4 style="color: white;">Customer Name : ' . $name . '</h4>
                <h4 style="color: white;">Email Id : ' . $email . '</h4>
                <h4 style="color: white;">Contact Number : ' . $contact . '</h4>
                <h4 style="color: white;">Delivery Address : ' . $address . '</h4>
                <h4 style="color: white;" >Payment Mode : ' . $paymentmode . '</h4>
                <h4 style="color: white;" >Total Amount Paid/ To Be Paid: ' . number_format($grand_total) . '</h4>
            </div>';
    echo $data;
}
