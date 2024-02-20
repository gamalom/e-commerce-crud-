<?php
session_start();

require_once('connection.php');

if (isset($_POST['add'])) {

    if (isset($_SESSION['cart'])) {
        // Cart is not empty
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id)) {
            // Product already exists in the cart
            echo "<script>alert('Product is already added to the cart!');</script>";
            echo "<script>window.location = 'index.php'</script>";
        } else {
            // Product does not exist in the cart, add it
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'productprice' => $_POST['productPrice'],
                'productname' => $_POST['productName'],
                'imagesource' => $_POST['imageSource']
            );
            $_SESSION['cart'][] = $item_array;
        }
    } else {
        // Cart is empty, add the product to the cart
        $item_array = array(
            'product_id' => $_POST['product_id'],
            'quantity' => $_POST['quantity'],
            'productprice' => $_POST['productPrice'],
            'productname' => $_POST['productName'],

            'imagesource' => $_POST['imageSource']
        );
        $_SESSION['cart'][] = $item_array;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
   
</head>
<body>

<?php
require_once("header.php");
?>
<hr>
 <h2 class="text-center">Food Menu List </h2>
 <hr>
 
<div class="container">
    <div class="row text-center py-5">
       
        <?php
        $result = mysqli_query($conn, "SELECT * FROM `producttb`");
        while ($row = mysqli_fetch_array($result)) {
            ?>
            
            <div class="col-md-4 col-sm-6 my-3 my-md-0 custom-container ">
                <form action="index.php" method="post">
                    <div class="custom-container p-3 ">
                        <div class="card shadow">
                            <div>
                                <img src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>"
                                     class="img-fluid card-img-top mb-3">
                                <input type="hidden" name="imageSource" value="<?php echo $row['product_image']; ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['product_name']; ?>
                                    <input type="hidden" name="productName" value="<?php echo $row['product_name']; ?>"></h5>
                                
                                
                                <h5>
                                <small class="text-muted"><strong>PRICE:</strong></small>
                                    <span class="price">Rs.<?php echo $row['product_price']; ?></span>
                                    <input type="hidden" name="productPrice"
                                           value="<?php echo $row['product_price']; ?>">
                                    <br>
                                    <label for="quantity" class="success">Quantity </label>
                                
                                  <input type="number" min="1" name="quantity" value="1" style="width: 2cm;">
                                </h5>
                                <button type="submit" class="btn btn-primary my-3" name="add">Book Now <i
                                            class="fas fa-solid fa-cart"></i></button>
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJ"></script>

</body>
</html>
