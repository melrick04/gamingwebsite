<?php

require 'config.php';

if (isset($_POST['action'])) {
    $sql = " SELECT * FROM product WHERE product_type !='' ";

    if (isset($_POST['product_type'])) {
        $product_type = implode("','", $_POST['product_type']);
        $sql .= "AND product_type IN('" . $product_type . "')";
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
                        <h4 class="card-text text-center text-danger">Price :&nbsp;&nbsp;<i class="fas fa-rupee-sign"></i> ' . number_format($row['product_price']) . '/-</h4>
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
