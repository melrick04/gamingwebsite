<?php

require 'config.php';

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

        /*
        echo '<div class="alert alert-warning alert-dismissible mt-2" >
                        <strong>Item added to cart!</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        */
    } else {

        echo 'no';

        /*
        echo '<div class="alert alert-warning alert-dismissible mt-2" >
                        <strong>Item already in cart!</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        */
    }
}

if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $conn->prepare("SELECT * FROM cart");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}
