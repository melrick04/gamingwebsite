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
            $output .= '<div class="col-md-3 mb-2">
            <div class="card-deck ">
                <div class="card border-secondary">
                    <img src="' . $row['product_image'] . '" class="card-img-top" height="400px">
                    <div class="card-img-overlay">
                        <h6 style="margin-top:370px;" class="text-dark bg-danger text-center rounded p-1 "> ' . $row['product_name'] . '</h6>
                    </div>
                    <br>
                    <div class="card-body">
                        <h4 class="card-title text-danger">Price : ' . number_format($row['product_price']) . '/-</h4>
                        <br>
                        <a href="#" class="btn btn-success btn-block">Add To Cart</a>
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
