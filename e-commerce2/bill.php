<?php
session_start(); // Start the session
require_once('connection.php'); // Include your database connection file


// Initialize tableNumber variable
$tableNumber = '';

$userName=($_SESSION['username']);

if (isset($_POST['tableNumber'])) {
    $tableNumber = $_POST['tableNumber'];
    
  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill and Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0 text-center">Bill</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $grandTotal = 0;

                                foreach ($_SESSION['cart'] as $array) {
                                    $name = $array['productname'];
                                    $quantity = $array['quantity'];
                                    $price = $array['productprice'];
                                    $image = $array['imagesource'];

                                    // Move the table number initialization inside the loop
                                    // Ensure that $tableNumber is properly set
                                    if (isset($_POST['tableNumber'])) {
                                        $tableNumber = $_POST['tableNumber'];
                                    }

                                    $total = $quantity * $price;
                                    $grandTotal += $total;

                                    // Insert each item into the ordertb table
                                    $result = mysqli_query($conn, "INSERT INTO `ordertb`(`id`,`quantity`, `product_price`, `product_image`, `product_name`, `flag`, `table`,`username`) VALUES ('','$quantity','$price','$image','$name','','$tableNumber','$userName')");

                                    if (!$result) {
                                        echo "Error: Unable to insert data into the database.";
                                    }

                                    echo '
                                        <tr>
                                            <th scope="row">' . $name . '</th>
                                            <td>' . $quantity . '</td>
                                            <td>$' . $price . '</td>
                                            <td>$' . $total . '</td>
                                        </tr>';
                                }

                                echo '<tr>
                                        <td colspan="3">Grand Total</td>
                                        <td>$' . $grandTotal . '</td>
                                    </tr>
                                </tbody>
                            </table>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <form action="redirect.php" method="post" class="mt-3">
            <div class="text-center">
                <button class="btn btn-primary" type="submit">Payment</button>
            </div>
            <input type="hidden" name="tableNumber" value="<?php echo $tableNumber; ?>">
        </form>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJ"></script>
    </body>

</html>
