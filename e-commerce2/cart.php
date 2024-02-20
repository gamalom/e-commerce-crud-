<?php
session_start();



require_once "connection.php";

if (isset($_POST['remove'])) {
    // Remove the order from the database using the id
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value["product_id"] == $_POST['product_id']) {
            $p_id = $value["product_id"];
            $result = mysqli_query($conn, "DELETE FROM `ordertb` WHERE id = $p_id");
            unset($_SESSION['cart'][$key]);
            echo "<script>alert('Product has been removed.....!')</script>";
            echo "<script>window.location = 'cart.php'</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">
    <?php
    require_once "header.php";
    ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                <h5 class="text-center ">My booking list</h5>

                    <hr>
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $product_id = array_column($_SESSION['cart'], 'product_id');
                        $Quantity = array_column($_SESSION['cart'], 'quantity');
                        $result = mysqli_query($conn, "SELECT * FROM `ordertb`");

                        foreach ($_SESSION['cart'] as $array) {
                            $product_id = $array['product_id'];
                            $quantity = $array['quantity'];
                            $productprice = $array['productprice'];
                            $productname = $array['productname'];
                            $imagesource = $array['imagesource'];

                            
                            echo '
                                <form action="cart.php" method="post">
                                    <div class="border rounded cart-item">
                                        <div class="row bg-white">
                                            <div class="col-md-3 pl-0">
                                                <img src="' . $imagesource . '" alt="food" class="img-fluid">
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="pt-2">' . $productname . '</h5>
                                                <small class="text-secondary">Seller: I-daraz</small>
                                                <h5 class="pt-2">Rs' . $productprice . '</h5>
                                                <button type="submit" onclick="return confirm(\'Remove item from cart?\')" class="btn btn-danger mx-2" name="remove">Remove</button>
                                            </div>
                                            <div class="col-md-3 "> 
                                                <div class="fluid" >
                                                    <label for="quantity" style="border: 0; text:bold; font-size:22px;">Quantity: </label>
                                                    <input type="text" max="20" min="1" name="quantity" value="' . $quantity . '" readonly style="border: 0; text:bold; font-size:22px; width:40px;">
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="' . $product_id . '">
                                </form>';
                        }

                    } else {
                        echo "<h5>Cart is empty</h5>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25 "></div>
            <hr>
            
            <form action="order.php" method="POST">
                <div class="d-flex justify-content-center">
                    <button type="submit" onclick="return confirm('Are you sure for order?')" class="btn btn-success btn-lg" name="order">Order</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJ"></script>
</body>
</html>
