<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="bill.php">
                    <div class="form-group">
                        <label for="tableNumber">Table Number</label>
                        <input type="number" class="form-control" id="tableNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <input type="hidden" id="sessionUsername" value="<?php echo $_SESSION['username']; ?>">
                    <div class="error" id="errorMessage" style="color: red;"></div>
                    <button type="submit" class="btn btn-primary" onclick="return submitForm()">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <script>
        function submitForm() {
            var tableNumber = document.getElementById("tableNumber").value;
            var username = document.getElementById("username").value;
            var sessionUsername = document.getElementById("sessionUsername").value;
            var errorMessage = document.getElementById('errorMessage');
            errorMessage.innerHTML = "";

            if (sessionUsername !== username) {
                errorMessage.innerHTML = "Please enter a valid username.";
                return false;
            } else {
                return true;
            }
        }
    </script>

</body>

</html>
