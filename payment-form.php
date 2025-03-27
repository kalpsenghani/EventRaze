<?php
session_start();
include('includes/config.php');

if (isset($_GET['bookingid'])) {
    $bookingid = $_GET['bookingid'];
} else {
    // If no booking ID is provided, redirect to the home page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0w6I9i54X3Fzpgq8iJrFSg9BfOeObiAX7Bv3exh9RS8AY4wz" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .payment-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #007bff;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            box-shadow: none;
            padding: 15px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 18px;
            padding: 15px 25px;
            width: 100%;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
        .footer a {
            color: #007bff;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .payment-card {
            border: 1px solid #ced4da;
            padding: 20px;
            border-radius: 8px;
            background-color: #f8f9fa;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="payment-title">Enter Your Payment Details</h2>

        <div class="payment-card">
            <h4>Booking ID: <?php echo htmlentities($bookingid); ?></h4>
            <form id="paymentForm" action="process-payment.php" method="POST">
                <input type="hidden" name="bookingid" value="<?php echo $bookingid; ?>">

                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter your card number" required>
                    <small id="cardError" class="text-danger" style="display:none;">Please enter a valid card number with 16 digits.</small>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="expiry_date">Expiry Date (MM/YY)</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                        <small id="expiryError" class="text-danger" style="display:none;">Please enter a valid expiry date.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" required>
                        <small id="cvvError" class="text-danger" style="display:none;">CVV should be 3 digits long.</small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="100" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
        </div>

        <div class="footer">
            <p>By submitting your payment details, you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zyV9hF4g3ANv5kJr59zTfs24y7sswD6a8pPp3p9f5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateCardNumber(cardNumber) {
            const regex = /^[0-9]{16}$/; // Ensure the card number is exactly 16 digits
            return regex.test(cardNumber);
        }

        function validateExpiryDate(expiryDate) {
            const regex = /^(0[1-9]|1[0-2])\/\d{2}$/; // MM/YY format
            return regex.test(expiryDate);
        }

        function validateCVV(cvv) {
            return cvv.length === 3; // CVV should be 3 digits
        }

        document.getElementById("paymentForm").addEventListener("submit", function(event) {
            const cardNumber = document.getElementById("card_number").value;
            const expiryDate = document.getElementById("expiry_date").value;
            const cvv = document.getElementById("cvv").value;
            let isValid = true;

            // Validate card number
            if (!validateCardNumber(cardNumber)) {
                document.getElementById("cardError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("cardError").style.display = "none";
            }

            // Validate expiry date
            if (!validateExpiryDate(expiryDate)) {
                document.getElementById("expiryError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("expiryError").style.display = "none";
            }

            // Validate CVV
            if (!validateCVV(cvv)) {
                document.getElementById("cvvError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("cvvError").style.display = "none";
            }

            // Prevent form submission if any validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
